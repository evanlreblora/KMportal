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
                  <tr v-for="(abd, index) in abds.data" :key="abd.id">
                    <td :title="abd.id">
                      {{ page + index + 1 }}
                    </td>
                    <td>{{ abd.filename }}</td>
                    <td>{{ abd.desc }}</td>
                    <td>{{ abd.unit }}</td>
                    <td>
                      {{ abd.type }}
                    </td>
                    <td>
                     {{ abd.uploader }}
                    </td>
                    <td>
                      
                      <a href="#" @click.prevent="downloadUser(abd)" title="Download">
                        <i class="fa fa-download blue"></i>
                      </a>
                      <span class="yellow">/</span>
                      <a href="#" title="Edit" @click="openUserModal(abd)">
                        <i class="fa fa-edit indigo"></i>
                      </a>
                      <span class="yellow">/</span>
                      <a href="#" @click.prevent="deleteUser(abd)" title="Remove">
                        <i class="fa fa-trash red"></i>
                      </a>

                    </td>
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
                {{ editable ? "Update's ASEAN Biodiv data" : "Add New" }}
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
import axios from 'axios';
export default {
  data() {
    return {
      abds: {},
      
    
      editable: false,
      page: 0,
      gateadmin: this.$gate.isAdminOrAuthor(),
      // Create a new form instance
      form: new Form({
        id: "",
        filename: "",
        desc: "",
        unit: "",
        type: "",
        uploader: "",
        filepath: ""
        // file:"",

      }),
    };
  },

  methods: {

    // onFileChange(event) {
    //   this.filepath = event.target.files[0];
    // },
    openUserModal(user = null) {
      // clear the errors
      this.form.clear();
      // resets the form
      this.form.reset();
      if (user.id) {
        this.editable = true;
        this.form.fill(user);
      } else {
        this.editable = false;
      }
      $("#userModal").modal("show");
    },

    onSubmit() {
      if (this.editable) {
        this.updateUser();
      } else {
        this.createUser();
      }
    },

    async getUsers(page = 1) {
      if (!this.$gate.isAdminOrAuthor()) return false;
      try {
        const abds = await axios.get(`/api/abds/?page=${page}`);
        this.abds = abds.data;
      } catch (error) {
        console.log(error.message);
      }
    },
    // Our method to GET results from a Laravel endpoint
    getResults(page = 1) {
      this.page = (page - 1) * 10;
      this.getUsers(page);
    },
    

 

    onFileChange(e) {
      console.log("select file", e.target.files[0])
      this.filepath = e.target.files[0];
      
    },
    async createUser() {
      //  e.preventDefault();
     
      const config = {
          header: { "content_type": "multipart/form-data"}
      }
      try {
        // Submit the form via a POST request
        this.$Progress.start();

        let fd = new FormData();
        fd.append('filename', this.form.filename); 
        fd.append('desc', this.form.desc);
        fd.append('unit', this.form.unit);
        fd.append('type', this.form.type);
        fd.append('uploader', this.form.uploader);
        fd.append('filepath', this.filepath);
        
        await axios.post('api/abds',fd,config );
        //.then(res=>{
        //   console.log('Response', res.data)
        // }).catch(err=>console.log(err))
        // modal close after submit
        // need to modify later
        $("#userModal").modal("hide");
        window.Toast.fire({
          icon: "success",
          title: "User Created successfully",
        });

        // updated the list
        window.Fire.$emit("loadUser");

        this.$Progress.finish();
      } catch (error) {
        this.$Progress.fail();
        window.Toast.fire({
          icon: "error",
          title: "File cannot created",
        });
      }
    },
    async updateUser() {
      this.$Progress.start();
      if (!this.form.password?.length) {
        this.form.password = undefined;
      }
      try {
        await this.form.put(`/api/abds/${this.form.id}`);
        $("#userModal").modal("hide");
        Swal.fire("Updated!", `File is updated`, "success");
        this.$Progress.finish();

        // update the view
        window.Fire.$emit("loadUser");
      } catch (error) {
        this.$Progress.fail();
        Swal.fire("Failed!", `File cannot be updated`, "error");
        console.log(error);
      }
    },
    async deleteUser(user) {
      // delete the user
      try {
        const result = await window.Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        });

        if (result.isConfirmed) {
          await this.form.delete(`/api/abds/${user.id}`);
          Swal.fire("Deleted!", `User has been deleted`, "success");
        }
      } catch (error) {
        Swal.fire("Failed!", `User cannot be deleted`, "error");
      }
      // update the view
      window.Fire.$emit("loadUser");
    },
    async downloadUser(user) {
      // download the user
      try {
        const result = await window.Swal.fire({
          title: "Are you sure to download this file?",
          text: "You won't be able to revert this!",
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Download it!",
        });

        if (result.isConfirmed) {
          await this.form.download(`/api/abds/${user.id}`);
          Swal.fire("Downloading!", "success");
        }
      } catch (error) {
        Swal.fire("Failed!", `File cannot be download`, "error");
      }
      // update the view
      window.Fire.$emit("loadUser");
    },
  },
  mounted() {
    this.getUsers();

    // fired fire event
    window.Fire.$on("loadUser", () => {
      this.getUsers();
    });

    window.Fire.$on("search", (search) => {
      this.page = 0;
      axios
        .get(`/api/searchpolicybr?q=${search}`)
        .then((data) => {
          // console.log(data.data);
          this.abds = data.data;
        })
        .catch((e) => {
          console.log(e);
        });
    });
  },
};
</script>
