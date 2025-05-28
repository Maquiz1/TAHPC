<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\ContactUsModel;
use App\Models\HabariMpyaDocumentModel;
use App\Models\HabariMpyaModel;
use App\Models\SliderModel;
use App\Models\StaffModel;
use App\Models\TopNavbarModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller{
// |
    //function that return login page
    public function welcome(request $request){
        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $sliderProfile = DB::table('slider_section')
            ->select('position','value','name','title')
            ->where('status','=','active')
            ->where('position','=','profile')
            ->get();

        $sliderCarousel = DB::table('slider_section')
            ->select('position','value','name','title')
            ->where('status','=','active')
            ->where('position','=','carousel')
            ->get();

        $habariMpayQuery = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','habari')
            ->orderBy('id','desc')->limit(10)->get();

        $taarifaQuery = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','taarifa')
            ->orderBy('id','desc')->limit(8)->get();

        $matukioQuery = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','matukio')
            ->orderBy('id','desc')->limit(5)->get();

        $videoQuery = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','video')
            ->orderBy('id','desc')->limit(5)->get();

        return view('welcome',['title'=>'Home','left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center,
            'sliderProfile'=>$sliderProfile,'sliderCarousel'=>$sliderCarousel,
            'habari'=>$habariMpayQuery,'taarifa'=>$taarifaQuery,'matukio'=>$matukioQuery,'videos'=>$videoQuery]);
    }

    //function that authenticate user
    public function loginPage(request $request){
        return view('admin.auth');
    }

    //function that return dashboard page
    public function index(request $request){
        return view('admin.admin');
    }

    //function that return dashboard page
    public function contactUs(request $request){
        return view('admin.contact-us');
    }

    //function that authenticate user
    public function authUser(request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $authenticate = auth()->attempt($request->only('email', 'password'));
        if (!$authenticate) {
            $data = ['error' => 'Wrong credentials supplied, Review your input and try again!'];
            echo json_encode($data);
            exit();
        } else {
            $user = Auth::user();
            session(['user' => $user]);


            if($user->status != 'active'){
                $data = ['error' => 'Your account is not active. Please contact administrator!'];
                echo json_encode($data);
                exit();
            }
            Auth::login($user);
            $data = ['success' => 'Logged in successfully!'];
            echo json_encode($data);
        }
    }

    //function that sign out account
    public function logout(request $request){
        $timeoutStatus = $request->input('session_timeout');

        sleep(1);

        $userId = Auth::user()->id;
        if (isset($timeoutStatus)){
            $details = 'logged out, session timeout';
        }else{
            $details = 'logged out';
        }

        User::saveLoggedInAt($userId,$details);

        Auth::guard('web')->logout();
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    //function that validate user
    public function validateUser(Request $request): void {
        $request->validate([
            'phone' => 'required',
        ]);
        $userModel = User::query()->select('*')->where('phone','=',$request->input('phone'))->count();
        if($userModel > 0){
            $data = ['success' => '100'];
        }else{
            $data = ['error' => 'user not found'];
        }
        echo json_encode($data);
    }

    //function that validate user
    public function processContactUs(Request $request): void {
        $request->validate([
            'contact-fname' => 'required|string',
            'contact-lname' => 'required|string',
            'contact-email' => 'required|string',
            'contact-subject' => 'required|string',
            'contact-message' => 'required|string',
        ]);

        $fname = ucwords(strtolower($request->input('contact-fname')));
        $lname = ucwords(strtolower($request->input('contact-lname')));
        $email = strtolower($request->input('contact-email'));
        $subject = ucwords(strtolower($request->input('contact-subject')));
        $message = ucwords(strtolower($request->input('contact-message')));

        $contactUsQuery = DB::table('contact_us')->select('*')->where('email','=',$email)
            ->where('read','=','unseen')
            ->whereDate('created_at','=',date('Y-m-d'))
            ->count();
        if($contactUsQuery <= 2){
            $contactData = [
                'first_name'=>$fname,
                'last_name'=>$lname,
                'email'=>$email,
                'subject'=>$subject,
                'message'=>$message,
                'uuid'=>Str::uuid()
            ];
            $contactModel = new ContactUsModel;
            $contactModel->fill($contactData);
            if($contactModel->save()){
                $data = ['success' => 'Your message has been received! Thank you.'];
            }else{
                $data = ['error' => 'Something went wrong, failed to send message! Try again later!'];
            }
        }else{
            $data = ['error'=>'You have reached the daily limit of 3 messages. Please wait for a response to your previous message. Thank you for your patience..'];
        }
        echo json_encode($data);
    }

    //function that handle navabar form
    public function navbarForm(Request $request){
        $request->validate([
            'top-position' => 'required|string',
        ]);

        $position = $request->input('top-position');
        if($position == 'left' || $position == 'right'){
            $request->validate([
                'logo' => 'required|mimes:png,svg|max:2048',
            ]);

            //validate only one logo for right and left should be uploaded
            $requestValidate = DB::table('top_navbar')->select('*')
                ->where('status','=','active')
                ->where('position','=',$position)
                ->count();
            if($requestValidate >= 1){
                $data = ['error' => 'Logos for both the left and right sides have already been uploaded. To update them, please remove the existing logos first.'];
                echo json_encode($data);
                exit();
            }
            //clear continue ...
            $image = $request->file('logo');
            $newFileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $value = $image->storeAs('uploads', $newFileName, 'public');
        }else{
            $request->validate([
               'center-text' => 'required',
            ]);
            $value = strtoupper(strtolower($request->input('center-text')));

            $requestValidate = DB::table('top_navbar')->select('*')
                ->where('status','=','active')
                ->where('position','=','center')
                ->count();
            if($requestValidate >= 2){
                $data = ['error' => 'Text for center sides have already been set. To update them, please remove the existing text first.'];
                echo json_encode($data);
                exit();
            }
        }
        $navbarData = [
            'position' => $position,
            'data' => $value,
            'created_at'=>Carbon::now(),
            'created_by'=>Auth::user()->id,
            'uuid' => Str::uuid()
        ];

        $navbarModel = new TopNavbarModel();
        $navbarModel->fill($navbarData);
        if($navbarModel->save()){
            $data = ['success' => 'Request completed successfully!'];
        }else{
            $data = ['error' => 'Something went wrong, fail to save request. Review your input and try again!'];
        }
        echo json_encode($data);
    }

    //top navbar call back
    public function topNavbarCallBack(request $request){
        return response()->json(TopNavbarModel::topNavbarCallBack());
    }

    //function that issued by details
    public static function getIssuedByUser($id): string{
        $query      =   DB::table('users')->select('first_name','last_name')->where('id','=',$id)->limit(1)->get();
        if ($query->count() >0){
            return $query->first()->first_name.' '.$query->first()->last_name;
        }else{
            return '';
        }
    }

    public static function getContentImage($content_id){
        return DB::table('habari_mpya_documents')
            ->where('habari_id', '=', $content_id)
            ->where('status', '=', 'active')
            ->first();
    }

    public static function getContentMultipleDocuments($content_id){
        return DB::table('habari_mpya_documents')
            ->where('habari_id', '=', $content_id)
            ->where('status', '=', 'active')
            ->get();
    }

    //function that remove top navbar data
    public function removeData(Request $request) {
        $request->validate([
            'elementKey' => 'required|string',
            'elementKey1' => 'required|string',
        ]);
        $elementKey = $request->input('elementKey');
        $tableName = $request->input('elementKey1');

        $query = DB::table($tableName)->where('uuid','=',$elementKey)->limit(1)->update([
                'status'=>'inactive',
                'updated_by'=>Auth::user()->id,
                'updated_at'=>Carbon::now(),
            ]);
        if($query){
            $data = ['success' => 'Request completed successfully!'];
        }else{
            $data = ['error'=>'Something went wrong, fail to complete your request. Refresh the page and try again!'];
        }
        echo json_encode($data);
    }

    //function that add slider data
    public function sliderForm(Request $request) {

        $request->validate([
           'position'=>'required|string',
           'profile'=>'required|mimes:png,svg,jpg,jpeg|max:5048',
        ]);
        $option = $request->input('position');

        DB::beginTransaction();

        //clear continue ...
        $image = $request->file('profile');
        $newFileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $value = $image->storeAs('uploads', $newFileName, 'public');

        if ($option == 'profile'){
            $request->validate([
                'profile-title'=>'required|string',
                'profile-name'=>'required|string',
            ]);
            $title = ucwords(strtolower($request->input('profile-title')));
            $name = ucwords(strtolower($request->input('profile-name')));

            $sliderData = [
                'position'=>$option,
                'value'=>$value,
                'name'=>$name,
                'title'=>$title,
                'created_at'=>Carbon::now(),
                'created_by'=>Auth::user()->id,
                'uuid' => Str::uuid()
            ];

            //validate profile only two images required
            $profileValidate = DB::table('slider_section')
                ->select('*')
                ->where('position','=','profile')
                ->where('status','=','active')->count();
            if($profileValidate >= 2){
                DB::rollBack();
                $data = ['error' => 'Profiles have already been uploaded. To update them, please remove the existing profile first.'];
                echo json_encode($data);
                exit();
            }
        }else{
            $sliderData = [
                'position'=>$option,
                'value'=>$value,
                'created_at'=>Carbon::now(),
                'created_by'=>Auth::user()->id,
                'uuid' => Str::uuid()
            ];
            //validate profile only two images required
            $sliderValidate = DB::table('slider_section')
                ->select('*')
                ->where('position','=','carousel')
                ->where('status','=','active')->count();

            if($sliderValidate >= 5){
                DB::rollBack();
                $data = ['error' => 'Carousel images have already been uploaded only five images allowed. To update them, please remove the existing image first.'];
                echo json_encode($data);
                exit();
            }
        }

        $sliderModel = new SliderModel();
        $sliderModel->fill($sliderData);
        if($sliderModel->save()){
            DB::commit();
            $data = ['success' => 'Request completed successfully!'];
        }else{
            DB::rollBack();
            $data = ['error'=>'Something went wrong, fail to complete your request. Refresh the page and try again!'];
        }
        echo json_encode($data);
    }

    //slider section call back
    public function contentSectionCallBack(request $request){
        return response()->json(HabariMpyaModel::contentSectionCallBack());
    }

    //slider section call back
    public function contactUsCallBack(request $request){
        return response()->json(ContactUsModel::contentSectionCallBack());
    }

    public function contactUsCount(request $request){
        $data = DB::table('contact_us')->select('*')->where('status', '=', 'active')
            ->where('read', '=', 'unseen')
            ->count();
        echo json_encode($data);
    }

    //slider section call back
    public function readFeedBack(request $request){
        $request->validate([
            'elementKey'=>'required|string',
        ]);
        $elementKey = $request->input('elementKey');
        return response()->json(ContactUsModel::readFeedBack($elementKey));
    }

    //slider section call back
    public function sliderSectionCallBack(request $request){
        return response()->json(SliderModel::sliderSectionCallBack());
    }

    //function that handle  pages content form
    public function pagesContent(Request $request) {
        $request->validate([
            'category'=>'required|string',
        ]);

        $category = $request->input('category');

        if ($category == 'about' || $category == 'version') {
            $request->validate([
                'content-description'=>'required|string',
            ]);
        }
        $description = $request->input('content-description');
        if ($category == 'members' || $category == 'team') {
            $request->validate([
                'user-title'=>'required|string',
                'user-full-name'=>'required|string',
            ]);

            $contentData = [
                'category'=>$category,
                'title'=>$category,
                'short_description'=>$category,
                'body'=>$category,
                'created_at'=>Carbon::now(),
                'published_at'=>Carbon::now(),
                'created_by'=>Auth::user()->id,
                'title_p'=>ucwords(strtolower($request->input('user-title'))),
                'full_name'=>ucwords(strtolower($request->input('user-full-name'))),
                'uuid'=>Str::uuid()
            ];
        }else{
            $contentData = [
                'category'=>$category,
                'title'=>$category,
                'short_description'=>$category,
                'body'=>$description,
                'created_at'=>Carbon::now(),
                'published_at'=>Carbon::now(),
                'created_by'=>Auth::user()->id,
                'uuid'=>Str::uuid()
            ];
        }

        $attachment = $request->file('content-attachment');
        $attachmentType = $request->input('attachment-type');


        DB::beginTransaction();
        $contentModel = new HabariMpyaModel();
        $contentModel->fill($contentData);
        if($contentModel->save()){

            if ($request->hasFile('content-attachment') && $attachmentType != ''){
                $newFileName = time() . '_' . uniqid() . '.' . $attachment->getClientOriginalExtension();
                $value = $attachment->storeAs('uploads', $newFileName, 'public');

                $contentId = $contentModel->id;
                if($contentId){
                    //save document
                    $documentData = [
                        'habari_id'=>$contentId,
                        'document_type'=>$attachmentType,
                        'document_path'=>$value,
                        'created_at'=>Carbon::now(),
                        'created_by'=>Auth::user()->id,
                        'uuid'=>Str::uuid(),
                    ];
                    $documentModel = new HabariMpyaDocumentModel();
                    $documentModel->fill($documentData);
                    if($documentModel->save()){
                        DB::commit();
                        $data = ['success' => 'Request completed successfully!'];
                    }else{
                        DB::rollBack();
                        $data = ['error'=>'Something went wrong, fail to save content.'];
                    }
                }else{
                    DB::rollBack();
                    $data = ['error'=>'Something went wrong, fail to save content.'];
                }
            }else{
                DB::commit();
                $data = ['success' => 'Request completed successfully!'];
            }
        }else{
            DB::rollBack();
            $data = ['error'=>'Something went wrong, fail to save content.'];
        }
        echo json_encode($data);
    }

    //function that handle content form
    public function contentForm(Request $request) {
        $request->validate([
            'category'=>'required|string',
            'content-title'=>'required|string',
            'short-description'=>'required|string',
            'content-description'=>'required|string',
            'attachment-type'=>'required|string',
            'content-attachment' => 'required|mimes:jpg,jpeg,pdf,mp4|max:50480',
        ]);

        $category = $request->input('category');
        $title = strtoupper(strtolower($request->input('content-title')));
        $short_description = $request->input('short-description');
        $description = $request->input('content-description');
        $attachment = $request->file('content-attachment');

        $attachmentType = $request->input('attachment-type');
        $newFileName = time() . '_' . uniqid() . '.' . $attachment->getClientOriginalExtension();
        $value = $attachment->storeAs('uploads', $newFileName, 'public');

        $contentData = [
            'category'=>$category,
            'title'=>$title,
            'short_description'=>$short_description,
            'body'=>$description,
            'created_at'=>Carbon::now(),
            'published_at'=>Carbon::now(),
            'created_by'=>Auth::user()->id,
            'uuid'=>Str::uuid()
        ];

        DB::beginTransaction();
        $contentModel = new HabariMpyaModel();
        $contentModel->fill($contentData);
        if($contentModel->save()){
            $contentId = $contentModel->id;
            if($contentId){
                //save document
                $documentData = [
                    'habari_id'=>$contentId,
                    'document_type'=>$attachmentType,
                    'document_path'=>$value,
                    'created_at'=>Carbon::now(),
                    'created_by'=>Auth::user()->id,
                    'uuid'=>Str::uuid(),
                ];
                $documentModel = new HabariMpyaDocumentModel();
                $documentModel->fill($documentData);
                if($documentModel->save()){
                    DB::commit();
                    $data = ['success' => 'Request completed successfully!'];
                }else{
                    DB::rollBack();
                    $data = ['error'=>'Something went wrong, fail to save content.'];
                }
            }else{
                DB::rollBack();
                $data = ['error'=>'Something went wrong, fail to save content.'];
            }
        }else{
            DB::rollBack();
            $data = ['error'=>'Something went wrong, fail to save content.'];
        }
        echo json_encode($data);
    }

    public function moreDetailsPage($contentKey) {

        if ($contentKey){
            $leftLogo = DB::table('top_navbar')
                ->select('position','data')
                ->where('status','=','active')
                ->where('position','=','left')
                ->first();

            $rightLogo = DB::table('top_navbar')
                ->select('position','data')
                ->where('status','=','active')
                ->where('position','=','right')
                ->first();

            $center = DB::table('top_navbar')
                ->select('position','data')
                ->where('status','=','active')
                ->where('position','=','center')
                ->get();

            //
            $itemQuery = DB::table('habari_mpya')->select('habari_mpya.*')->where(['habari_mpya.uuid'=>$contentKey])->get();

            return view('pages.more_details', ['title'=>'More Details','left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center,'content'=>$itemQuery]);
        }
    }

    public function aboutUs(Request $request){
        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $aboutQuery = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','about')
            ->orderBy('id','desc')->first();

        return view('pages.about-us', ['title'=>'About Us', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center, 'about'=>$aboutQuery]);
    }

    public function missionIndex(Request $request){
        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $visionQuery = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','vision')
            ->orderBy('id','desc')->first();

        return view('pages.mission-vision', ['title'=>'Mission & Vision', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center,'vision'=>$visionQuery]);
    }

    public function councilMemberIndex(Request $request){
        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $memberQuery = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','members')
            ->orderBy('id','asc')->get();

        return view('pages.council-member', ['title'=>'Council Member', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center, 'members'=>$memberQuery]);
    }

    public function managementTeamIndex(Request $request){
        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $teamQuery = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','team')
            ->orderBy('id','asc')->get();

        return view('pages.management-team', ['title'=>'Management Team', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center, 'team'=>$teamQuery]);
    }

    public function contactUsIndex(Request $request){
        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        return view('pages.contact-us', ['title'=>'Contact Us', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center]);
    }

    public function registrationIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $traditionalCitizen = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','traditional-citizen')
            ->orderBy('id','desc')->first();


        return view('pages.registration', ['title'=>'Traditional Citizen', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center,
            'traditionalCitizen'=>$traditionalCitizen]);
    }

    public function traditionalNonCitizenIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $traditionalCitizen = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','traditional-noncitizen')
            ->orderBy('id','desc')->first();

        return view('pages.massage-citizen', ['title'=>'Traditional NonCitizen', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center,
            'pageContent'=>$traditionalCitizen]);
    }

    public function alternativelyCitizenIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $alternativeCitizen = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','alternatively-citizen')
            ->orderBy('id','desc')->first();

        return view('pages.alternative-citizen', ['title'=>'Alternatively Citizen', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center, 'alternativeCitizen'=>$alternativeCitizen]);
    }

    public function alternativelyNonCitizenIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','alternatively-noncitizen')
            ->orderBy('id','asc')->first();

        return view('pages.alternative-non-citizen', ['title'=>'Alternative Non Citizen', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center,
            'pageContent'=>$pageContent]);
    }

    public function massageCitizenIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','massage-citizen')
            ->orderBy('id','desc')->first();

        return view('pages.massage-citizen', ['title'=>'Massage Citizen', 'left'=>$leftLogo,'right'=>$rightLogo,
            'center'=>$center,'pageContent'=>$pageContent]);
    }

    public function medicineSeller(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','medicine-seller')
            ->orderBy('id','desc')->first();

        return view('pages.massage-citizen', ['title'=>'Traditional Medicine Seller', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center,
            'pageContent'=>$pageContent]);
    }

    public function assistantAlternativeIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','assistant-alternative')
            ->orderBy('id','desc')->first();

        return view('pages.massage-citizen', ['title'=>'Assistant Alternatively Health Practitioner ', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center,'pageContent'=>$pageContent]);
    }


    public function assistantTraditionalIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','assistant-traditional')
            ->orderBy('id','desc')->first();

        return view('pages.massage-citizen', ['title'=>'Assistant Traditional Health Practitioner', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center,'pageContent'=>$pageContent]);
    }

    public function traditionalMedicineShrineIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','traditional-medicine-shrine')
            ->orderBy('id','desc')->first();

        return view('pages.facilities', ['title'=>'Traditional Medicine Shrine', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center,'pageContent'=>$pageContent]);
    }

    public function traditionalMedicineClinicIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','traditional-medicine-clinic')
            ->orderBy('id','desc')->first();

        return view('pages.facilities', ['title'=>'Traditional Medicine Clinic', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center,'pageContent'=>$pageContent]);
    }

    public function alternativelyMedicineClinicIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','alternatively-medicine-clinic')
            ->orderBy('id','desc')->first();

        return view('pages.facilities', ['title'=>'Alternatively Medicine Clinic ', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center,'pageContent'=>$pageContent]);
    }

    public function traditionalMedicineHealthCentreIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','traditional-health-centre')
            ->orderBy('id','desc')->first();

        return view('pages.facilities', ['title'=>'Traditional Medicine Health Centre', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center, 'pageContent'=>$pageContent]);
    }


    public function alternativelyMedicineHealthCentre(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','alternative-health-centre')
            ->orderBy('id','desc')->first();

        return view('pages.facilities', ['title'=>'Alternatively Medicine Health Centre', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center,'pageContent'=>$pageContent]);
    }

    public function traditionalMedicineHospital(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','traditional-medicine-hospital')
            ->orderBy('id','desc')->first();

        return view('pages.facilities', ['title'=>'Traditional Medicine Hospital', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center,'pageContent'=>$pageContent]);
    }

    public function alternativeMedicineHospital(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','alternative-medicine-hospital')
            ->orderBy('id','desc')->first();

        return view('pages.facilities', ['title'=>'Alternative Medicine Hospital', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center,'pageContent'=>$pageContent]);
    }

    public function traditionalMedicineStore(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

          $pageContent = DB::table('habari_mpya')
              ->select('*')
              ->where('status','=','active')
              ->where('category','=','traditional-medicine-store')
              ->orderBy('id','desc')->first();

        return view('pages.facilities', ['title'=>'Traditional Medicine Store', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center,'pageContent'=>$pageContent]);
    }


    public function registrationTraditionalMedicine(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','traditional-medicine-registration')
            ->orderBy('id','desc')->first();

        return view('pages.medicines', ['title'=>'Registration Of Traditional Medicines', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center, 'pageContent'=>$pageContent]);
    }

    public function registrationAlternativeMedicine(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','alternative-medicine-registration')
            ->orderBy('id','desc')->first();

        return view('pages.medicines', ['title'=>'Registration Of Alternative Medicines ', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center, 'pageContent'=>$pageContent]);
    }

    public function enlistingTraditionalMedicines(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','enlisting-traditional-medicine')
            ->orderBy('id','desc')->first();

        return view('pages.medicines', ['title'=>'Enlisting Traditional Medicines', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center, 'pageContent'=>$pageContent]);
    }


    public function importingMedicines(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','importing-medicine')
            ->orderBy('id','desc')->first();

        return view('pages.medicines', ['title'=>'Importing Medicines', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center, 'pageContent'=>$pageContent]);
    }

    public function exportingMedicines(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        $pageContent = DB::table('habari_mpya')
            ->select('*')
            ->where('status','=','active')
            ->where('category','=','exporting-medicine')
            ->orderBy('id','desc')->first();

        return view('pages.medicines', ['title'=>'Exporting Medicines', 'left'=>$leftLogo,
            'right'=>$rightLogo,'center'=>$center, 'pageContent'=>$pageContent]);
    }

    public function licencingIndex(Request $request){

        $leftLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','left')
            ->first();

        $rightLogo = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','right')
            ->first();

        $center = DB::table('top_navbar')
            ->select('position','data')
            ->where('status','=','active')
            ->where('position','=','center')
            ->get();

        return view('pages.licencing', ['title'=>'Contact Us', 'left'=>$leftLogo,'right'=>$rightLogo,'center'=>$center]);
    }

}
