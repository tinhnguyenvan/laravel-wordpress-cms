<div class="form-group">
    <div class="controls">
        @include('admin.element.form.radio', ['name' => $name, 'text' => 'Input', 'valueDefault' => "input", 'value' => $value])
        @include('admin.element.form.radio', ['name' => $name, 'text' => 'Textarea', 'valueDefault' => "textarea", 'value' => $value])
    </div>
</div>