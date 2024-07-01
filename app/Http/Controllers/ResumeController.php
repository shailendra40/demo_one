<?php

namespace App\Http\Controllers;
use App\Models\Resume;
use Illuminate\Http\Request;
use App\Models\ImageConveter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ResumeController extends Controller {
    public function index() {
        // $resume = Resume::all();
        $resumes=Resume::latest()->paginate(4);
        return view( 'resume.index', compact( 'resumes' ) );
    }

    public function create() {
        $resume = Resume::all();
        return view( 'resume.create', compact( 'resume' ) );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string',
            'qualification' => 'required|string',
            'experience' => 'required|string',
            // 'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ] );

        try {
            $resume = new Resume;
            $resume->name = $request->name;
            $resume->email = $request->email;
            $resume->phone = $request->phone;
            $resume->address = $request->address;
            $resume->qualification = $request->qualification;
            $resume->experience = $request->experience;

            if ( $request->hasFile( 'image' ) ) {
                $imageNames = [];
                foreach ( $request->file( 'image' ) as $file ) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $file->move( public_path( '/uploads/images' ), $imageName );
                    $imageNames[] = $imageName;
                }
                // Convert array of image names to JSON before storing in the database
                $resume->image = json_encode( $imageNames );
            }

            $resume->save();
            return redirect()->route( 'resume.index' )->with( 'success', 'Resume created successfully!' );
        } catch ( \Exception $e ) {
            return redirect()->back()->with( 'error', 'Failed to create resume: ' . $e->getMessage() );
        }
    }

    public function delete( $id ) {
        $resume = Resume::find( $id );
        if ( $resume ) {
            $resume->delete();
            // return redirect()->route( 'resume.index' );
            route("resume.delete", $resume->id);
        }

        return redirect()->back()->with( 'success', 'Resume deleted successfully!' );
    }

    public function edit( $id ) {
        $resume = Resume::find( $id );
        // return view( 'resume.update', compact( 'resume' ) );
        // route("resume.edit", $resume->id);
        return view('resume.update', compact(['resume']));
    }

    public function preview($id)
    {
        $resume = Resume::find($id);
        return view('resume.show', compact('resume'));
    }



    public function resume($id)
    {
        $resume = Resume::find($id);

        if (!$resume) {
            return response()->json(['error' => 'Resume not found'], 404);
        }

        return response()->json([
            'id' => $resume->id,
            'name' => $resume->name,
            // Include other fields as needed
        ]);
    }








        // return view('resume.preview', compact('resume'));
        // return view('resume.index', compact('resume'));
        // route('resume.preview', ['id' => $resume->id]);
        // route('resume.index', ['id' => $resume->id]);

    public function update( Request $request, $id ) {

        $request->validate( [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string',
            'qualification' => 'required|string',
            'experience' => 'required|string',
            // 'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the max file size as needed
        ] );

        // dd( $request );
        try {
            $resume = Resume::find($id);

            if (!$resume) {
                return redirect()->back()->with('error', 'Resume not found.');
            }
            $resume->name = $request->name;
            $resume->email = $request->email;
            $resume->phone = $request->phone;
            $resume->address = $request->address;
            $resume->qualification = $request->qualification;
            $resume->experience = $request->experience;
            if ( $request->hasFile( 'image' ) ) {

                // $destination = '/uploads/images'.$resume->$imageName;
                // $destination = 'uploads/images/' . $resume->imageName; // Assuming $resume->imageName holds the image file name
                // if(File::exists($destination))
                // {
                //     File::delete($destination);
                // }

                $imageNames = [];
                foreach ( $request->file( 'image' ) as $file ) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $file->move( public_path( '/uploads/images' ), $imageName );
                    $imageNames[] = $imageName;
                }
                // Convert array of image names to JSON before storing in the database
                $resume->image = json_encode( $imageNames );
            }

            $resume->save();

            return redirect()->route( 'resume.index' )->with( 'success', 'Resume created successfully!' );

        } catch ( \Exception $e ) {
            return redirect()->back()->with( 'error', 'Failed to create resume: ' . $e->getMessage() );
        }
    }

}
