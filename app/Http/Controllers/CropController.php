<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CropController extends Controller
{
    /**
     * @OA\Post(
     *     path="/farmer/create-corp",
     *     operationId="createCrop",
     *     tags={"Crops"},
     *     summary="Create a new crop",
     *     description="Logs crop data in the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="farmer_id", type="integer"),
     *                 @OA\Property(property="crop_name", type="string"),
     *                 @OA\Property(property="crop_type", type="string"),
     *                 @OA\Property(property="average_amount", type="number", format="float"),
     *                 @OA\Property(property="harvest_cycles", type="integer"),
     *                 @OA\Property(property="availability_start", type="string", format="date"),
     *                 @OA\Property(property="availability_end", type="string", format="date"),
     *                 @OA\Property(property="crop_image", type="string", format="binary")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Crop data logged successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function create()
    {
        return view('cropLogCreate');
    }

    /**
     * @OA\Post(
     *     path="/farmer/create-corp",
     *     operationId="storeCrop",
     *     tags={"Crops"},
     *     summary="Store crop data",
     *     description="Stores crop data in the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="farmer_id", type="integer"),
     *                 @OA\Property(property="crop_name", type="string"),
     *                 @OA\Property(property="crop_type", type="string"),
     *                 @OA\Property(property="average_amount", type="number", format="float"),
     *                 @OA\Property(property="harvest_cycles", type="integer"),
     *                 @OA\Property(property="availability_start", type="string", format="date"),
     *                 @OA\Property(property="availability_end", type="string", format="date"),
     *                 @OA\Property(property="crop_image", type="string", format="binary")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Crop data stored successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'farmer_id' => 'required|exists:users,id',
            'crop_name' => 'required|string',
            'crop_type' => 'required|string',
            'average_amount' => 'required|numeric|min:1',
            'harvest_cycles' => 'required|integer|min:1',
            'crop_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'availability_start' => 'required|date',
            'availability_end' => 'required|date|after_or_equal:availability_start',
        ]);

        $imagePath = $request->file('crop_image')->store('crop_images', 'public');

        Crop::create([
            'farmer_id' => $validated['farmer_id'],
            'crop_name' => $validated['crop_name'],
            'crop_type' => $validated['crop_type'],
            'average_amount' => $validated['average_amount'],
            'harvest_cycles' => $validated['harvest_cycles'],
            'crop_image' => $imagePath,
            'availability_start' => $validated['availability_start'],
            'availability_end' => $validated['availability_end'],
        ]);

        return redirect()->back()->with('success', 'Crop data logged successfully!');
    }

    /**
     * @OA\Get(
     *     path="/farmer",
     *     operationId="getCrops",
     *     tags={"Crops"},
     *     summary="Get list of crops",
     *     description="Retrieve all available crops.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="crop_name", type="string"),
     *                 @OA\Property(property="crop_type", type="string")
     *             )
     *         )
     *     )
     * )
     */

    public function index(Request $request)
    {
        $query = Crop::query();

        if ($request->crop_type) {
            $query->where('crop_type', $request->crop_type);
        }

        if ($request->start_date) {
            $query->whereDate('availability_start', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('availability_end', '<=', $request->end_date);
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('crop_name', 'like', '%' . $search . '%');
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
            $query->orderBy($sort, $order);
        }

        $crops = Crop::with('prices')
        ->when($request->has('crop_type'), function ($query) use ($request) {
            $query->where('crop_type', $request->input('crop_type'));
        })
        ->when($request->has('start_date'), function ($query) use ($request) {
            $query->whereDate('availability_start', '>=', $request->input('start_date'));
        })
        ->when($request->has('end_date'), function ($query) use ($request) {
            $query->whereDate('availability_end', '<=', $request->input('end_date'));
        })

        ->get()
        ->sortByDesc(function ($crop) {
            return is_null($crop->prices) || is_null($crop->prices->price_per_kg);
        });

        $crops = $query->with('prices')->paginate(10);
        return view('crops.index', compact('crops'));
    }

    /**
     * @OA\Get(
     *     path="/farmer/crops/{crop}/details",
     *     operationId="getCrop",
     *     tags={"Crops"},
     *     summary="Get details of a specific crop",
     *     description="Retrieve detailed information about a specific crop.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the crop to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="crop_name", type="string"),
     *             @OA\Property(property="crop_type", type="string"),
     *             @OA\Property(property="price_per_kg", type="number", format="float")
     *         )
     *     )
     * )
     */

    public function show(Crop $crop)
    {
        return view('crops.show', compact('crop'));
    }
/**
 * @OA\Get(
 *     path="/farmer/crops/{id}/edit",
 *     operationId="editCrop",
 *     tags={"Crops"},
 *     summary="Show the form for editing a specific crop",
 *     description="Returns the view for editing a crop based on the provided ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the crop to be edited",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Form view for editing the crop loaded successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Form for editing the crop loaded successfully.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Crop not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="Crop not found")
 *         )
 *     )
 * )
 */
    public function edit($id)
    {
        $crop = Crop::with('prices')->findOrFail($id);
        return view('crops.edit', compact('crop'));
    }

/**
 * @OA\Put(
 *     path="/farmer/crops/{id}",
 *     operationId="updateCrop",
 *     tags={"Crops"},
 *     summary="Update an existing crop",
 *     description="Updates crop details in the database.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the crop to update",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(property="crop_name", type="string"),
 *                 @OA\Property(property="crop_type", type="string"),
 *                 @OA\Property(property="average_amount", type="number", format="float"),
 *                 @OA\Property(property="harvest_cycles", type="integer"),
 *                 @OA\Property(property="price_per_kg", type="number", format="float"),
 *                 @OA\Property(property="availability_start", type="string", format="date"),
 *                 @OA\Property(property="availability_end", type="string", format="date"),
 *                 @OA\Property(property="crop_image", type="string", format="binary")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Crop updated successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Crop details updated successfully."),
 *             @OA\Property(property="crop_id", type="integer", example="1")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="Validation failed."),
 *             @OA\Property(property="details", type="array", @OA\Items(type="string"))
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Crop not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="Crop not found.")
 *         )
 *     )
 * )
 */

    public function update(Request $request, $id)
    {
        $request->validate([
            'crop_name' => 'required|string|max:255',
            'crop_type' => 'required|string|max:255',
            'average_amount' => 'required|numeric|min:0',
            'harvest_cycles' => 'required|integer|min:1',
            'price_per_kg' => 'required|numeric|min:0',
            'availability_start' => 'required|date',
            'availability_end' => 'required|date|after:availability_start',
            'crop_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $crop = Crop::findOrFail($id);
        $crop->crop_name = $request->input('crop_name');
        $crop->crop_type = $request->input('crop_type');
        $crop->average_amount = $request->input('average_amount');
        $crop->harvest_cycles = $request->input('harvest_cycles');
        $crop->availability_start = $request->input('availability_start');
        $crop->availability_end = $request->input('availability_end');

        if ($request->hasFile('crop_image')) {
            if ($crop->crop_image && Storage::exists('public/' . $crop->crop_image)) {
                Storage::delete('public/' . $crop->crop_image);
            }

            $path = $request->file('crop_image')->store('crop_images', 'public');
            $crop->crop_image = $path;
        }

        $crop->save();

        $price = $crop->prices()->firstOrNew();
        $price->price_per_kg = $request->input('price_per_kg');
        $price->save();

        return redirect()->route('crops.show', ['crop' => $crop->id])->with('success', 'Crop details updated successfully.');
    }
}
