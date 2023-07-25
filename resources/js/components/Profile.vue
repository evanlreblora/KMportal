<style scoped>
.widget-user .widget-user-header {
    background-image: url("/img/user-cover.jpg");
    background-size: cover;
    background-position: center center;
    height: 250px;
}
</style>

<template>
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user ">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white bg-info">
                        <h3 class="widget-user-username text-right">
                            {{user.name}}
                        </h3>
                        <h5 class="widget-user-desc text-right">
                            {{user.type}}
                        </h5>
                    </div>
                    <div class="widget-user-image">
                        <img
                            class="img-circle"
                            :src="getProfilePhoto()"
                            alt="User Avatar"
                        />
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text"
                                        >FOLLOWERS</span
                                    >
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text"
                                        >PRODUCTS</span
                                    >
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
        <section class="content py-2">
            <div class="clearfix">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a
                                            class="nav-link"
                                            href="#activity"
                                            data-toggle="tab"
                                            >Activity</a
                                        >
                                    </li>

                                    <li class="nav-item">
                                        <a
                                            class="nav-link active"
                                            href="#settings"
                                            data-toggle="tab"
                                            >Settings</a
                                        >
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane" id="activity">

                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane active" id="settings">
                                        <form
                                            @submit.prevent="updateUser"
                                            @keydown="form.onKeydown($event)"
                                        >
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input
                                                    v-model="form.name"
                                                    type="text"
                                                    id="name"
                                                    name="name"
                                                    class="form-control"
                                                    placeholder="Name"
                                                    :class="{
                                                        'is-invalid': form.errors.has(
                                                            'name'
                                                        )
                                                    }"
                                                />
                                                <has-error
                                                    :form="form"
                                                    field="name"
                                                ></has-error>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>

                                                <input
                                                    v-model="form.email"
                                                    id="email"
                                                    type="email"
                                                    name="email"
                                                    class="form-control"
                                                    placeholder="Email address"
                                                    autocomplete="nope"
                                                    :class="{
                                                        'is-invalid': form.errors.has(
                                                            'email'
                                                        )
                                                    }"
                                                />
                                                <has-error
                                                    :form="form"
                                                    field="email"
                                                ></has-error>
                                            </div>



                                            <div class="form-group">
                                                <label for="bio">Bio</label>

                                                <textarea
                                                    v-model="form.bio"
                                                    name="bio"
                                                    id="bio"
                                                    class="form-control"
                                                    placeholder="write short bio"
                                                    :class="{
                                                        'is-invalid': form.errors.has(
                                                            'bio'
                                                        )
                                                    }"
                                                ></textarea>
                                                <has-error
                                                    :form="form"
                                                    field="bio"
                                                ></has-error>
                                            </div>
                                            <div class="form-group">
                                                <label for="photo">Profile Photo</label>
                                                <input
                                                    type="file"
                                                    id="photo"
                                                    name="photo"
                                                    class="form-control"
                                                    placeholder="photo"
                                                    @change="fileUpload"
                                                    :class="{
                                                        'is-invalid': form.errors.has(
                                                            'photo'
                                                        )
                                                    }"
                                                />
                                                <has-error
                                                    :form="form"
                                                    field="photo"
                                                ></has-error>
                                            </div>
                                            <div class="form-group">
                                                <label for="passport">Passport (leave empty if not changing)</label>
                                                <input
                                                    v-model="form.password"
                                                    type="password"
                                                    id="password"
                                                    name="password"
                                                    class="form-control"
                                                    placeholder="password"
                                                    autocomplete="new-password"
                                                    :class="{
                                                        'is-invalid': form.errors.has(
                                                            'password'
                                                        )
                                                    }"
                                                />
                                                <has-error
                                                    :form="form"
                                                    field="password"
                                                ></has-error>
                                            </div>

                                            <button
                                                type="submit"
                                                :disabled="form.busy"
                                                class="btn btn-success btn-lg"
                                            >
                                                Update
                                            </button>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: [],
            path: '/img/profile/',
            // Create a new form instance
            form: new Form({
                id: "",
                name: "",
                email: "",
                password: "",
                bio: "",
                photo: "profile.png"
            })
        };
    },
    methods: {
        async getUser() {
            const user = await axios.get("/api/profile");
            this.user = user.data;
            this.form.clear();
            this.form.reset();
            this.form.fill(this.user);
            // console.log(user);
        },
        getProfilePhoto(){
            return `${this.path}${this.form.photo}`;
        },
        fileUpload(e) {
            const fileTypes = ['jpg', 'jpeg', 'png', 'gif'];  //acceptable file types
            const file = e.target.files[0];
            const extension = file.name.split('.').pop().toLowerCase();  //file extension from input file
            const isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types
            // check file type
            if(!isSuccess){
                 Swal.fire(
                    "Failed!",
                    `File type ${file.type} does not support`,
                    "error"
                );
                this.form.file = null;
                return false;
            }
            // check file size
            if(file.size > 2097152){
                Swal.fire(
                    "Failed!",
                    `File Size ${(file.size/1024/1024).toFixed(2)} MB is large.`,
                    "error"
                );
                this.form.file = null;
                return false;
            }
            const reader = new FileReader();
            reader.onloadend =  evt => {
                this.path = '';
                this.form.photo =  evt.target.result;
            };
            reader.readAsDataURL(file);
            console.log(file);
        },
        async updateUser(e) {
            this.$Progress.start();
            if(!this.form.password?.length){
                this.form.password = undefined;
            }
            try {
                await this.form.put(`/api/profile/`);
                Swal.fire(
                    "Updated!",
                    `User ${this.form.name} is updated`,
                    "success"
                );
                this.$Progress.finish();
                // update the view
                // window.Fire.$emit("loadUser");
            } catch (error) {
                this.$Progress.fail();
                Swal.fire(
                    "Failed!",
                    `User ${user.name} cannot be updated`,
                    "error"
                );
                console.log(error);
            }
        },
    },
    mounted() {
        this.getUser();
        // fired fire event
        // window.Fire.$on("loadUser", () => {
        //     this.getUser();
        // });
    }
};
</script>