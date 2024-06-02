<?php

namespace App\Http\Controllers;

use App\Repository\News\NewsRepository;
use App\Requests\News\FindNewsRequest;
use App\Requests\News\GetNewsRequest;
use App\Requests\News\UpdateNewsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class NewsController extends Controller
{


    public function __construct(private readonly NewsRepository $newsRepository)
    {
    }

    /**
     * @OA\Get(
     * path="/v1/news",
     * summary="Get news",
     * description="Display a listing of the news",
     * operationId="NewsController.index()",
     * tags={"News"},
     *  @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Filtering by title",
     *         required=false,
     *         example="Some news title"
     *      ),
     *   @OA\Response(
     *         response=200,
     *         description="OK",
     *          @OA\JsonContent(
     *          type="array",
     *            @OA\Items( ref="#/components/schemas/News"),
     *        ),
     *   )
     * )
     */
    public function index(GetNewsRequest $getNewsRequest): JsonResponse
    {
        return response()->json($this->newsRepository->get(
            $getNewsRequest->getFilter()
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/v1/news/{url}",
     *     summary="Find news",
     *     tags={"News"},
     *     @OA\Parameter(
     *         description="Find a concrete news",
     *         in="path",
     *         name="url",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="string", value="some-url-example", summary="A string value"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *          @OA\JsonContent(
     *             ref="#/components/schemas/News"
     *        ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="News not found",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="message", type="string", example="News not found"),
     *       @OA\Property(property="status", type="bool", example="false"),
     *    )
     * ),
     * )
     */
    public function show(FindNewsRequest $findNewsRequest, string $url): JsonResponse
    {
        return response()->json($this->newsRepository->find(
            $findNewsRequest->getFilter()
        )->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Put(
     * path="/v1/news",
     * summary="Update data",
     * description="Update news data",
     * operationId="NewsController.update()",
     * tags={"News"},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Set news status",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="status", type="int", format="int", description="News status", example="1"),
     *    ),
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="success", type="bool", example="true"),
     *        ),
     *     ),
     *
     * @OA\Response(
     *    response=404,
     *    description="News not found",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="message", type="string", example="News not found"),
     *       @OA\Property(property="status", type="bool", example="false"),
     *    )
     * ),
     * )
     */
    public function update(UpdateNewsRequest $updateNewsRequest): JsonResponse
    {
        return response()->json([
            'status' => $this->newsRepository->update(
                $updateNewsRequest->getFilter()
            )
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
