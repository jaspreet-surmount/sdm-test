<!-- Pop-up model form -->

@inject('program', 'App\Program')

    {!! Form::open([
         'method' => 'post',
         'route'  => 'student.store',
         'files'  => true,
         'class'  => 'form-horizontal',
         'id'     => 'add-student-form',
    ]) !!}

    <div class="col-md-12 error-message"></div>

    <span class="help-block marginleft10 text-italic marginbottom8">
        {!! Lang::get('common.mandatory_text', ['required' => '<span class="colorRed"><b>*</b></span>']) !!}
    </span>

    <div class="modal-body">
        <div class="form-group">
            <div class="col-md-6">
                <label class="control-label" for="full-name">
                    {!! Lang::get('student.full_name') !!} <span class="colorRed">*</span>
                </label>
                {!! Form::text('full_name', null, ['id' => 'full-name', 'class' => 'form-control', ]) !!}
            </div>

            <div class="col-md-6">
                <label class="control-label" for="dob">
                    {!! Lang::get('student.col_dob') !!} <span class="colorRed">*</span>
                </label>
                {!! Form::text('dob', null, ['id' => 'dob', 'class' => 'form-control keyNotAllowed', ]) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <label class="control-label" for="contact-number">
                    {!! Lang::get('student.col_contact_number') !!}
                </label>
                {!! Form::text('contact_number', null, ['id' => 'contact-number', 'class' => 'form-control keyNumSingle', ]) !!}
            </div>

            <div class="col-md-6">
                <label for="gender" class="control-label">
                    {!! Lang::get('student.col_gender') !!} <span class="colorRed">*</span>
                </label>
                <div class="radio">
                    <div class="radio-primary radio-inline">
                        <label for="{{ Config::get('constants.GENDER')[0] }}">
                            {!! Form::radio('gender', Config::get('constants.GENDER')[0], true, ['id' => Config::get('constants.GENDER')[0]]) !!}
                            {!! \Lang::get('student.gender.' . Config::get('constants.GENDER')[0])  !!}
                        </label>
                    </div>
                    <div class="radio-warning radio-inline">
                        <label for="{{ Config::get('constants.GENDER')[1] }}">
                            {!! Form::radio('gender', Config::get('constants.GENDER')[1], null, ['id' => Config::get('constants.GENDER')[1]]) !!}
                            {!! \Lang::get('student.gender.' . Config::get('constants.GENDER')[1])  !!}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-10 margintop15">
                <label class="control-label" for="favorite-subjects">
                    {!! Lang::get('student.col_favorite_subjects') !!}
                </label>
                <div class="checkbox">
                    @foreach (\Config::get('constants.FAVORITE_SUBJECTS') as $subject)
                            <label class="control-label marginright10">
                                {!! Form::checkbox('favorite_subjects[]', $subject, null, ['id' => $subject, ]) !!}
                                {!! \Lang::get('student.favourite_subjects.'.$subject) !!}
                            </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <label class="control-label" for="program">
                    {!! Lang::get('student.col_program') !!} <span class="colorRed">*</span>
                </label>
                {!! Form::select('program', [
                    '' => Lang::get('common.default_select_option')
                ] + $program->lists('name', 'id')->toArray(), null, ['id' => 'other-activities', 'class' => 'form-control', ]) !!}
            </div>

            <div class="col-md-6">
                <label class="control-label" for="other-activities">
                    {!! Lang::get('student.col_other_activities') !!}
                </label>
                {!! Form::textarea('other_activities', null, ['id' => 'other-activities', 'class' => 'form-control', 'rows' => 3 ]) !!}
            </div>
        </div>
    </div>

    <div class="modal-footer clearfix">
        {!! Form::submit(Lang::get('common.submit'), ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @include('js-helper.student')