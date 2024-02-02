<link href="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.css" rel="stylesheet" />
<style>
  /* .filepond--root, */
  .filepond--root .filepond--drop-label {
    height: 150px;
  }
  /* bordered drop area */
  .filepond--panel-root {
    background-color: transparent;
    border: 2px dashed #ced4da;
  }
</style>

<div class="modal fade" id="modal_import_mhs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Import Mahasiswa PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-import" action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row mb-2 justify-content-between">
            <div class="col-auto">
              <p class="m-0">File yang didukung: .xls, .xlsx</p>
            </div>
            <div class="col-auto">
              <a href="/download_file/private/template/template-import-mhs.xlsx">Download Template</a>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <input type="file" name="file" id="file">
              <div id="file-err" class="invalid-feedback"></div>
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-auto">
              <button class="btn btn-primary" type="button" id="btn-import-mhs">Import</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1/dist/filepond-plugin-file-validate-type.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.js"></script>
<script>
  // Register the plugin
  FilePond.registerPlugin(
    FilePondPluginFileValidateType,
  );

  // Get a reference to the file input element
  const inputElement = document.querySelector('input[id="file"]');

  // Create a FilePond instance
  const pond = FilePond.create(inputElement,{
    storeAsFile: true,
    stylePanelLayout: 'compact',
    labelIdle: `<i class="bi bi-upload fs-2"></i><br>Drag & Drop file atau <span class="filepond--label-action">Browse</span>`,
    acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'],
    labelFileTypeNotAllowed: 'File tidak sesuai format',
    fileValidateTypeLabelExpectedTypes: 'Hanya mendukung file .xlsx atau .xls',
    credits: false,
  });

</script>