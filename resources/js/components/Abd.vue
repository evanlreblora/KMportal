<template>
  <div class="users-data-wrapper" style="width: 100%">
    <div class="container" >
      <div class="row mt-5">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">ASEAN Biodiversity Dashboard Table</h3>
  
                  <div class="card-tools">
                    <button class="btn btn-success" @click="openUserModal">
                      Upload Report
                  <i class="fas fa-plus fa-fw"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
  
            <!-- <div class="container mx-auto mt-4">
                <div class="row">
                  <div v-for="annualreport  in annualreports.data" :key="annualreport.id" class="col-md-3">
                    <div class="card" style="width: 16rem">
                      <img
                        src="/images/squareCard.svg"
                        class="card-img-top"
                        alt="..."
                      />
                      <div class="card-body">
                        <h5 class="card-title">{{ annualreport.filename }}</h5>
   
                        <p class="card-text">
                          {{ annualreport.desc }}
                        </p>
                        <a href="#" class=" mr-2"  @click="viewUserModal(annualreport)"><i class="fas fa-eye green"></i>View</a> 
                        <a href="#"  class="mr-2" title="Edit" @click="openUserModal(annualreport)">
                          <i class="fa fa-edit indigo"></i>Edit
                        </a>
                        <a v-if="gateadmin" class="mr-2" href="#" @click.prevent="deleteUser(annualreport)" title="Remove">
                          <i class="fa fa-trash red"></i>Delete
                        </a>
                    </div>
                  </div>
              </div>
   
   
  
                </div>
              </div> -->
              
              <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Filename</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Type</th>
                    <th>Uploader</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <pagination
                :data="abds"
                :limit="3"
                :show-disabled="true"
                align="center"
                @pagination-change-page="getResults"
              ></pagination>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- Modal -->
      <div
        class="modal fade"
        id="userModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="userModalTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="userModalTitle">
                {{ editable ? "Update's ASEAN Biodiversity Dashboard data" : "Add New" }}
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form
              @submit.prevent="onSubmit" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <input
                    v-model="form.filename"
                    type="text"
                    name="filename"
                    class="form-control"
                    placeholder="Filename"
                    :class="{
                      'is-invalid': form.errors.has('filename'),
                    }"
                  />
                  <has-error :form="form" field="filename"></has-error>
                </div>

                <div class="form-group">
                  <input
                    v-model="form.desc"
                    type="desc"
                    name="desc"
                    class="form-control"
                    placeholder="Description"
                    autocomplete="off"
                    :class="{
                      'is-invalid': form.errors.has('desc'),
                    }"
                  />
                  <has-error :form="form" field="desc"></has-error>
                </div>

             <div class="form-group">
                <select
                  v-model="form.unit"
                  name="unit"
                  class="form-control"
                  placeholder="Unit"
                  :class="{
                    'is-invalid': form.errors.has('unit'),
                  }"
                >
                  <option value="" selected disabled>Select Unit</option>
                  <option value="BIM">BIM</option>
                  <option value="CPA">CPA</option>
                  <option value="PDI">PDI</option>
                </select>
                <has-error :form="form" field="unit"></has-error>
              </div>

              <div class="form-group">
                <select
                  v-model="form.type"
                  name="type"
                  class="form-control"
                  placeholder="Type"
                  :class="{
                    'is-invalid': form.errors.has('type'),
                  }"
                >
                  <option value="" selected disabled>Select Type</option>
                  <option value="PDF">PDF</option>
                  <option value="PNG">PNG/JPEG</option>
                  <option value="Docx">DOCX</option>
                  <option value="HTML">HTML</option>
                  <option value="PPT">PPT</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>

                <div class="form-group">
                  <input
                    v-model="form.uploader"
                    type="uploader"
                    name="uploader"
                    class="form-control"
                    placeholder="Uploader"
                    autocomplete="off"
                    :class="{
                      'is-invalid': form.errors.has('uploader'),
                    }"
                  />
                  <has-error :form="form" field="uploader"></has-error>
                </div>
             
                  <div class="form-group">       
                      <input          
                          type="file"
                          ref="pdfFileInput"
                          id="filepath"
                          name="filepath"
                          class="form-control"
                          placeholder="filepath"
                           v-on:change="onFileChange"
                          :class="{
                              'is-invalid': form.errors.has(
                                  'filepath'
                              )
                          }"
                      />
                      
                      <has-error
                          :form="form"
                          field="filepath"
                      ></has-error>
                    </div>
                  </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                  Close
                </button>
                <button
                  type="submit"
                  :disabled="form.busy"
                  :class="editable ? 'btn btn-success' : 'btn btn-primary'"
                >
                 {{ editable ? "Update" : "Submit" }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
 
  </div>
</template>

<script>
</script>
