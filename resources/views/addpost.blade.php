<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
  <form action="{{ route('addpost') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Postingan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
            @csrf
            <div class="card-body">
               <div class="row">
                  <div class="col-md-2 text-right mt-1">
                     <label for="">
                        Upload Foto
                     </label>
                  </div>
                  <div class="col-md-8">
                     <div>
                        <input type="file" class="form-control font-size-11" name="image" id="profil">
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-md-2 text-right mt-1">
                     <label for="">
                        Caption
                     </label>
                  </div>
                  <div class="col-md-8">
                     <textarea class="form-control font-size-11" name="caption" rows="3"></textarea>
                  </div>
               </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah Postingan</button>
      </div>
    </div>
    </form>
  </div>
</div>