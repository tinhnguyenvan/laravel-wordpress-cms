<div class="tab-pane active">
    @include('admin.element.form.input', ['name' => 'to', 'id' => 'to', 'text' => 'To', 'value' => old('to')])
    @include('admin.element.form.input', ['name' => 'subject', 'id' => 'subject', 'text' => 'Subject', 'value' => old('subject')])
    @include('admin.element.form.textarea', ['name' => 'body', 'id' => 'body', 'text' => 'Body', 'value' => old('body')])
</div>