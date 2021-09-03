@props(['max_file' => 1])
<style>
    .dropzone {
        border: 2px dashed #0087F7 !important;
        border-radius: 5px;
        background: white !important;
    }

    .dropzone .dz-message {
        font-weight: 400;
    }

    .dropzone .dz-message .note {
        font-size: 0.8em;
        font-weight: 200;
        display: block;
        margin-top: 1.4rem;
    }


</style>
<link href="{{ asset("common/plugin/dropzonejs/dropzone.css") }}" rel="stylesheet">
<script src="{{ asset("common/plugin/dropzonejs/dropzone.js") }}" type="text/javascript"></script>

<div id="my-awesome-dropzone" class="dropzone">
    <div class="dropzone-file-area">
        <div class="dropzone-previews"></div>

        <div class="dz-default dz-message">
            <h3 class="sbold">Drop files here to upload</h3>
            <span>You can also click to open file browser</span>
        </div>
    </div>
</div>

<script>

    Dropzone.autoDiscover = false;

    let dropzone = new Dropzone("#my-awesome-dropzone", {
        url: "{{ admin_url('media/upload') }}",
        paramName: "upload",
        uploadMultiple: false,
        maxFiles: {{ $max_file }}, // 10 file
        maxFilesize: 2, // 2MB
        // autoProcessQueue: false,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
    });

    dropzone.on("removedfile", function (file) {
        // alert('remove triggered');
    });

    dropzone.on("addedfile", function (file) {
        // alert('add triggered');
    });

    dropzone.on("success", function (file) {

    });
</script>