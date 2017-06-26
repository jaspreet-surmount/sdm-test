<?php namespace App\Http\Controllers;

use App\Program;
use App\Student;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

class StudentController extends Controller
{
    /**
     * @var Student
     */
    protected $student;

    /**
     * @var Program
     */
    protected $program;

    /**
     * @var User
     */
    protected $user;

    /**
     * Inject the required models.
     *
     * @param Student $student
     * @param Program $program
     * @param User $user
     */
    public function __construct(Student $student, Program $program, User $user)
    {
        echo 'Testing...';
        $this->student = $student;
        $this->program = $program;
        $this->user    = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeDataTitle = \Lang::get('title.student_active_list');
        $inActiveDataTitle = \Lang::get('title.student_inactive_list');

        return view('student.index', compact('activeDataTitle', 'inActiveDataTitle'));
    }

    /**
     * @return mixed
     */
    public function getActiveData()
    {
        $students = $this->student->getData(1);

        return Datatables::of($students)
            ->editColumn('dob', "{!! date('j, M Y', strtotime(\$dob)) !!}")
            ->editColumn(
                'favorite_subjects',
                "{!! implode(', ', array_map('ucwords', explode(',', \$favorite_subjects))) !!}"
            )
            ->editColumn(
                'created_by_user',
                '@if ($updated_by_user)
                    {!! $created_by_user . \' / \' . $updated_by_user !!}
                @else
                    {!! $created_by_user !!}
                @endif'
            )
            ->editColumn('updated_at', function ($students) {
                return Carbon::createFromFormat("Y-m-d H:i:s", $students->updated_at)->diffForHumans();
            })
            ->addColumn('action', '{!! getStudentActions($id, $full_name, $created_by)!!}')
            ->removeColumn('id')
            ->removeColumn('updated_by_user')
            ->removeColumn('created_by')
            ->make();
    }

    /**
     * @return mixed
     */
    public function getInActiveData()
    {
        $students = $this->student->getData(0);
        return Datatables::of($students)
            ->editColumn('dob', "{!! date('j, M Y', strtotime(\$dob)) !!}")
            ->editColumn(
                'favorite_subjects',
                "{!! implode(', ', array_map('ucwords', explode(',', \$favorite_subjects))) !!}"
            )
            ->editColumn(
                'created_by_user',
                '@if ($updated_by_user)
                    {!! $created_by_user . \' / \' . $updated_by_user !!}
                @else
                    {!! $created_by_user !!}
                @endif'
            )
            ->editColumn('updated_at', function ($students) {
                return Carbon::createFromFormat("Y-m-d H:i:s", $students->updated_at)->diffForHumans();
            })
            ->addColumn('action', '{!! Html::link(
                "#",
                Lang::get("student.approve_data"),
                ["class" => "btn btn-xs btn-primary", "data-route" => URL::route("student.approve-data", [
                    "id" => $id
                ]), "onclick" => "confirmBox(this)"]
            )!!}')
            ->removeColumn('id')
            ->removeColumn('updated_by_user')
            ->removeColumn('created_by')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules());
        $data = $request->all();

        $data['program_id'] = $data['program'];
        $data['dob'] = date('Y-m-d', strtotime($data['dob']));

        if (\Config::get('constants.DEFAULT_ROLES.level_one') == $this->user->getUserRole()) {
            $data['is_active'] = 1;
        }

        $data['created_by'] = \Auth::id();

        try {
            $this->student->create($data);
        } catch (\Exception $e) {
            return \Redirect::back()->with('error', $e->getMessage());
        }

        return \Redirect::back()->with('success', \Lang::get('student.created_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->student->findOrFail($id);
        $favoriteSubjects = explode(',', $student->favorite_subjects);

        return view('student.edit', compact('student', 'favoriteSubjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->validationRules());
        $data = $request->all();

        $data['program_id'] = $data['program'];
        $data['dob'] = date('Y-m-d', strtotime($data['dob']));

        $data['last_updated_by'] = \Auth::id();
        try {
            $student = $this->student->findorFail($id);
            $student->update($data);
        } catch (\Exception $e) {
            return \Redirect::back()->with('error', $e->getMessage());
        }

        return \Redirect::back()
            ->with('success', \Lang::get('student.update_success', ['name' => $student->full_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $student = $this->student->findOrFail($id);
            $student->delete();
        } catch (\Exception $e) {
            return \Redirect::back()->with('error', $e->getMessage());
        }
        return \Redirect::back()
            ->with('success', \Lang::get('student.delete_success', ['name' => $student->full_name]));
    }

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'full_name'         => 'required',
            'dob'               => 'required',
            'contact_number'    => 'numeric|digits_between:'.implode(
                ',',
                \Config::get('constants.CONTACT_NUMBER_RANGE_LENGTH')
            ),
            'gender'            => 'required|in:'.implode(',', \Config::get('constants.GENDER')),
            'program'           => 'required',
        ];
    }

    /**
     * Can only perform by level 1 user
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveData($id)
    {
        try {
            $student = $this->student->findOrFail($id);
            $student->update(['is_active' => 1]);
        } catch (\Exception $e) {
            return \Redirect::back()->with('error', $e->getMessage());
        }

        return \Redirect::back()
            ->with('success', \Lang::get('student.data_approved_success', ['name' => $student->full_name]));
    }
}
