<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\API\TopicController as ApiTopicController;

class TopicTranslationController extends Controller
{
    public function index()
    {
        $apiController = new ApiTopicController();
        $response = $apiController->index();

        return $this->handleApiResponse($response);
    }

    public function show($id)
    {
        $apiController = new ApiTopicController();
        $response = $apiController->show($id);

        return $this->handleApiResponse($response);
    }

    public function create()
    {
        return view('topicsTranslation.create');
    }

    public function store(Request $request)
    {
        $apiController = new ApiTopicController();
        $response = $apiController->store($request);

        return $this->handleApiResponse($response);
    }

    public function edit($id)
    {
        $apiController = new ApiTopicController();
        $response = $apiController->edit($id);

        return $this->handleApiResponse($response);
    }

    public function update(Request $request, $id)
    {
        $apiController = new ApiTopicController();
        $response = $apiController->update($request, $id);

        return $this->handleApiResponse($response);
    }

    public function destroy($id)
    {
        $apiController = new ApiTopicController();
        $response = $apiController->destroy($id);

        return $this->handleApiResponse($response);
    }

    private function handleApiResponse($response)
    {
        if ($response->getStatusCode() == 200) {
            $data = $response->original['data'];

            return view('home', compact('data'));
        } else {
            return redirect()->route('error.page')->with('error', 'Failed to fetch data from API');
        }
    }
}
