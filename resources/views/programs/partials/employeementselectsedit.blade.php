<div class="col-md-7">
    <div class="form-group has-feedback {{$errors->has('employment_nature') ? 'has-error' : ''}}">
        <div>
            <label for="nature_of_the_employment" class="required">Employment</label>
        </div>
        <div class="inline margin-right-md">
            <input type="checkbox" id="employment_permanent" class="styled-checkbox" value="permanent"
                   name="employment_nature[]" {{ (is_array(old('employment_nature')) and in_array('permanent', old('employment_nature')) or \strpos($program->nature_of_the_employment, 'permanent') !== false) ? ' checked' : '' }}>
            <label for="employment_permanent">Permanent</label>
        </div>
        <div class="inline margin-right-md">
            <input type="checkbox" id="employment_fixed_contract" class="styled-checkbox" value="fixed contract"
                   name="employment_nature[]" {{ (is_array(old('employment_nature')) and in_array('fixed contract', old('employment_nature')) or \strpos($program->nature_of_the_employment, 'fixed contract') !== false) ? ' checked' : '' }}>
            <label for="employment_fixed_contract">Fixed Contract</label>
        </div>
        <div class="inline margin-right-md">
            <input type="checkbox" id="employment_job_contract" class="styled-checkbox" value="job contract"
                   name="employment_nature[]" {{ (is_array(old('employment_nature')) and in_array('job contract', old('employment_nature')) or \strpos($program->nature_of_the_employment, 'job contract') !== false) ? ' checked' : '' }}>
            <label for="employment_job_contract">Job Contract</label>
        </div>
        @if ($errors->has('employment_nature'))
            <span class="help-block">{{ $errors->first('employment_nature') }}</span>
        @endif
    </div>
</div>
<div class="col-md-5">
    <div class="form-group has-feedback {{$errors->has('employee_category') ? 'has-error' : ''}}">
        <div>
            <label class="required">Employee Category</label>
        </div>
        <div class="inline margin-right-md">
            <input type="checkbox" id="employee_category_tech" class="styled-checkbox" value="technical"
                   name="employee_category[]" {{ (is_array(old('employee_category')) and in_array('technical', old('employee_category')) or \strpos($program->employee_category, 'technical') !== false) ? ' checked' : '' }}>
            <label for="employee_category_tech">Technical</label>
        </div>
        <div class="inline">
            <input type="checkbox" id="employee_category_nontech" class="styled-checkbox" value="non-technical"
                   name="employee_category[]" {{ (is_array(old('employee_category')) and in_array('non-technical', old('employee_category')) or \strpos($program->employee_category, 'non-technical') !== false) ? ' checked' : '' }}>
            <label for="employee_category_nontech" class="">Non-Technical</label>
        </div>
        @if ($errors->has('employee_category'))
            <span class="help-block">{{ $errors->first('employee_category') }}</span>
        @endif
    </div>
</div>