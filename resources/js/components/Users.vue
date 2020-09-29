import axios from '../../../public/js/app';
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button
                                class="btn btn-success"
                                @click="openUserModal"
                            >
                                Add User <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Registerd At</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(user, index) in users"
                                    :key="user.id"
                                >
                                    <td :title="user.id">{{ index + 1 }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <span class="tag tag-success">{{
                                            user.type | capital
                                        }}</span>
                                    </td>
                                    <td>
                                        {{ user.created_at | customDate }}
                                    </td>
                                    <td>
                                        <a href="#" title="Edit">
                                            <i class="fa fa-edit indigo"></i>
                                        </a>
                                        <span class="yellow">/</span>
                                        <a
                                            href="#"
                                            @click.prevent="deleteUser(user)"
                                            title="Remove"
                                        >
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
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
                            Add New
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        @submit.prevent="createUser"
                        @keydown="form.onKeydown($event)"
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Name"
                                    :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="name"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <input
                                    v-model="form.email"
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Email address"
                                    autocomplete="off"
                                    :class="{
                                        'is-invalid': form.errors.has('email')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="email"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <input
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="password"
                                    autocomplete="off"
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

                            <div class="form-group">
                                <textarea
                                    v-model="form.bio"
                                    name="bio"
                                    class="form-control"
                                    placeholder="write short bio"
                                    :class="{
                                        'is-invalid': form.errors.has('bio')
                                    }"
                                ></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <select
                                    v-model="form.type"
                                    name="type"
                                    class="form-control"
                                    placeholder="Name"
                                    :class="{
                                        'is-invalid': form.errors.has('type')
                                    }"
                                >
                                    <option value="" selected disabled
                                        >Select User Role</option
                                    >
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="type"
                                ></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                type="submit"
                                :disabled="form.busy"
                                class="btn btn-success"
                            >
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            // Create a new form instance
            form: new Form({
                name: "",
                email: "",
                password: "",
                type: "",
                bio: "",
                photo: ""
            })
        };
    },

    methods: {
        openUserModal() {
            $("#userModal").modal("show");
            this.form.reset();
        },

        async getUsers() {
            const users = await axios.get("/api/users");
            this.users = users.data.data;
        },
        async createUser() {
            try {
                // Submit the form via a POST request
                this.$Progress.start();
                await this.form.post("/api/users");
                // modal close after submit
                // need to modify later
                $("#userModal").modal("hide");
                window.Toast.fire({
                    icon: "success",
                    title: "User Created successfully"
                });

                // updated the list
                window.Fire.$emit("loadUser");

                this.$Progress.finish();
            } catch (error) {
                window.Toast.fire({
                    icon: "error",
                    title: "User cannon created"
                });
            }
        },
        async deleteUser(user) {
            // delete the user
            const result = await window.Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            });

            if( result.isConfirmed ){
                await this.form.delete(`/api/users/${user.id}`);
                Swal.fire(
                    "Deleted!",
                   `User ${user.name} has been deleted`,
                    "success"
                );
            }
            // update the view
            window.Fire.$emit("loadUser");
        }
    },
    mounted() {
        this.getUsers();

        // fired fire event
        window.Fire.$on("loadUser", () => {
            this.getUsers();
        });
    }
};
</script>
