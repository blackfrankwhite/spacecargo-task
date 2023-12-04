<?php 

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Repositories\ParcelRepository;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    protected $parcelRepository;

    public function __construct(ParcelRepository $parcelRepository)
    {
        $this->parcelRepository = $parcelRepository;
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'code' => 'required|string|unique:parcels,code',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:1',
                'market_address' => 'required|string|max:255',
                'comment' => 'sometimes|string|nullable'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $parcel = $this->parcelRepository->createParcel($request->user(), $validatedData);
        return response()->json($parcel, 201);
    }

    public function index(Request $request)
    {
        $parcels = $this->parcelRepository->getUserParcels($request->user());
        return response()->json($parcels);
    }

    public function update(Request $request, Parcel $parcel)
    {
        $this->authorize('update', $parcel);
        try {
            $validatedData = $request->validate([
                'code' => 'required|string|unique:parcels,code,' . $parcel->id,
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:1',
                'market_address' => 'required|string|max:255',
                'comment' => 'sometimes|string|nullable'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $this->authorize('update', $parcel);

        $updatedParcel = $this->parcelRepository->updateParcel($parcel, $validatedData);
        return response()->json($updatedParcel);
    }
}
