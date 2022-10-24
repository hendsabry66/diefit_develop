<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Requests\CreateSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Image;

class SettingController extends AppBaseController
{
    /** @var SettingRepository $settingRepository*/
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Display a listing of the Setting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $public_settings = $this->settingRepository->allQuery(['setting_group_id'=>1])->get();
        $social_settings = $this->settingRepository->allQuery(['setting_group_id'=>2])->get();

        return view('admin.settings.index')
            ->with('public_settings', $public_settings)->with('social_settings', $social_settings);
    }

    /**
     * Show the form for creating a new Setting.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created Setting in storage.
     *
     * @param CreateSettingRequest $request
     *
     * @return Response
     */
    public function store(CreateSettingRequest $request)
    {
        $input = $request->all();

        $setting = $this->settingRepository->create($input);

        Flash::success('Setting saved successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified Setting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        return view('settings.show')->with('setting', $setting);
    }

    /**
     * Show the form for editing the specified Setting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        return view('settings.edit')->with('setting', $setting);
    }

    /**
     * Update the specified Setting in storage.
     *
     * @param int $id
     * @param UpdateSettingRequest $request
     *
     * @return Response
     */
    public function update( Request $request)
    {


        foreach($request->except(['method','_token']) as $key => $value) {

             $setting = Setting::where('key', $key)->first();

            if($setting->type == 'file' && request($key) != null && is_file(request($key))) {
                $img = Image::make($value);
                $imgPath = 'uploads/setting/';
                $imgName =time().$value->getClientOriginalName();
                $img =  $img->save($imgPath.$imgName);
                $setting->update(['value' => $imgName]);
            }elseif ($setting->type == 'checkbox' && request($key) != null){
                $setting->update(['value' => json_encode(request($key))]);
            } else {

                $setting->update(['value' => request($key)]);
            }
        }
        $messages = ['success' => "Successfully updated", 'redirect' => route('settings.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Remove the specified Setting from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        $this->settingRepository->delete($id);

        Flash::success('Setting deleted successfully.');

        return redirect(route('settings.index'));
    }
    /**
     * Bulk delete
     * @param Request $request
     *
     * @return \Illuminate\Support\Facades\Redirect
     *
     * @throws \Exception
     */
    public function bulkDelete(Request $request) {
        if (! $request->ids) {
            flash('قبل التأكيد على الاختيار المتعدد . من فضلك اختر من القائمة اولا')->error();
            return redirect()->back();
        }

        $this->CityRepository->bulkDelete($request->ids);

        flash('تم حذف المدن بنجاح')->success();
        return redirect()->back();
    }
}
