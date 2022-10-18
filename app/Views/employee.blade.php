@extends('default.main')
@section('content')
    <div id="app">
        <!-- Modal -->
        <div class="modal fade" id="show_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@{{ title_modal }} Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="modal_form" action="">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" :class="{'is-invalid' : errors.name }" :value="selectedData.name">
                                <div v-show="errors.name" :class="{'invalid-feedback' : errors.name}">
                                    <span>@{{ errors.name }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" :class="{'is-invalid' : errors.email }" :value="selectedData.email">
                                <div v-show="errors.email" :class="{'invalid-feedback' : errors.email}">
                                    <span>@{{ errors.email }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">IC Number</label>
                                <input type="text" class="form-control" name="icno" :class="{'is-invalid' : errors.icno }" :value="selectedData.icno">
                                <div v-show="errors.icno" :class="{'invalid-feedback' : errors.icno}">
                                    <span>@{{ errors.icno }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="proses_data(proses_modal)">@{{ title_btn_modal }} changes
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Example Data</h3>
                        
                        <div class="card-tools">
                            <div>
                                <button class="btn btn-sm btn-default" @click="show_filter = true" v-show="!show_filter">
                                    <i class="fas fa-filter"></i> Show Filter
                                </button>
                                <button class="btn btn-sm btn-default" @click="show_filter = false" v-show="show_filter">
                                    <i class="fas fa-filter"></i> Hide Filter
                                </button>
                            </div>
                            <div v-show="show_filter">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input @keyup="get_emp_listing(1)" v-model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default" @click="get_emp_listing(1)">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="100px">
                                    <button class="btn btn-success pull-right" @click="show_modal('add')">
                                        Add New Data
                                    </button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(e, index) in employee">
                                <td>@{{numbering+index+1}}.</td>
                                <td>@{{e.name}} <small>(@{{ e.icno }})</small></td>
                                <td>@{{e.email}}</td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm">
                                        <a href="javascript:void(0);" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-info" @click="show_modal('edit',e)"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger" @click="delete_data(e.id)"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <ul class="pagination">
                                    <li class="page-item" :class="{ active: index == page }" v-for="index in total_page">
                                        <a @click="get_emp_listing(index)" class="page-link" href="javascript:void(0);">@{{index}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col md-3">
                                <select class="form-control" v-model="selected" @change="get_emp_listing(1)">
                                    <option value="">Sila pilih</option>
                                    <option v-for="(a, index) in limit" :value="a">@{{ a }}</option>
                                </select>
                            </div>
                            <div class="col-md-4 text-right">
                                Papar muka <b>@{{page}}</b> dari <b>@{{total_page}}</b> (<b>@{{total_data}}</b> jumlah keputusan)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    
    <script>
        let urlApp = '{!! base_url().'/api/employee' !!}';

        let dataApp = {
            message: 'Hello Vue!',
            datenow: '',
            show_filter: false,
            limit: [5, 10, 20, 50, 100],
            selected: 10,

            title_modal: '',
            title_btn_modal: '',
            proses_modal: '',

            //employee data
            employee: [],
            search: '',
            page: 1,
            total_page: 1,
            per_page: 0,
            total_data: 0,
            numbering: 0,

            errors: [],

            selectedData: [],
            selected_id: '',
        };

        let methodApp = {
            show_date() {
            },
            show_modal(proses, data = '') {
                if (proses === 'add') {
                    this.errors = [];
                    this.title_modal = 'Add';
                    this.title_btn_modal = 'Save';
                    this.proses_modal = 'add';
                    this.selectedData = [];
                    this.selected_id = '';
                    $('#show_modal').modal('show');
                }

                if (proses === 'edit') {
                    this.errors = [];
                    this.title_modal = 'Edit';
                    this.title_btn_modal = 'Update';
                    this.proses_modal = 'update';
                    this.selectedData = data;
                    this.selected_id = data.id;
                    $('#show_modal').modal('show');
                }
            },
            proses_data(proses) {
                let self = this;
                let post_data = $('#modal_form').serialize();
                let id = (proses == 'update') ? '&id=' + self.selected_id : '';
                post_data = post_data + '&act=' + proses + id; // cara tambah parameter kat serialize
                //console.log(post_data);
                $.post(urlApp + '/proses_data', post_data, function (res) {
                    if (res) {
                        self.selectedData = res.populate;
                        self.errors = res.errors;
                    } else {
                        if (proses === 'add') {
                            Swal.fire('Success', 'Data Inserted', 'success');
                            $('#show_modal').modal('hide');
                            self.get_emp_listing(self.total_page);
                        } else {
                            Swal.fire('Success', 'Data Updated', 'success');
                            $('#show_modal').modal('hide');
                            self.get_emp_listing(self.page);
                        }

                    }
                });
            },
            delete_data(id) {
                Swal.fire({
                    title: 'Do you want to delete?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let self = this;
                        $.post(urlApp + '/delete_data', {del: id}, function (res) {
                            Swal.fire('Success','Data Deleted','success');
                            self.get_emp_listing(1);
                        });
                    }
                })
            },
            get_emp_listing(page = 1) {
                let self = this;
                self.page = page;
                $.post(urlApp, {
                    limit: self.selected,
                    page: self.page,
                    search: self.search,
                }, function (res) {
                    self.employee = res.data;
                    self.total_page = res.total_page;
                    self.per_page = res.per_page;
                    self.total_data = res.total_data;
                    self.numbering = ((self.page - 1) * res.per_page);
                    // console.log(self.selected);
                });
            },
        };

        let mountedApp = function (e) {
            e.show_date();
            e.get_emp_listing();
        }
    </script>
    @include('default.vue-default')
@endsection