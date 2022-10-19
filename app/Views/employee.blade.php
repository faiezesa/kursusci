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
                        <form id="modal_form" action="" ref="formku">
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
                            <div class="form-group">
                                <label for="">Race @{{ selectedData.race }}</label>
                                <select name="race" class="form-control" :class="{'is-invalid' : errors.race }">
                                    <option value="">-- Sila pilih --</option>
                                    <option :value="r.code" :selected="selectedData.race_code===r.code" v-for="r in race">@{{ r.race }}</option>
                                </select>
                                <div v-show="errors.race" :class="{'invalid-feedback' : errors.race}">
                                    <span>@{{ errors.race }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Religion</label>
                                <select name="religion" class="form-control" :class="{'is-invalid' : errors.religion }">
                                    <option value="">-- Sila pilih --</option>
                                    <option :value="r.code" :selected="selectedData.religion_code===r.code" v-for="r in religion">@{{ r.religion }}</option>
                                </select>
                                <div v-show="errors.religion" :class="{'invalid-feedback' : errors.religion}">
                                    <span>@{{ errors.religion }}</span>
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Name" v-model="filter_name" @keyup="get_emp_listing(1)">
                                    <div class="input-group-append">
                                        <button class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Email" v-model="filter_email" @keyup="get_emp_listing(1)">
                                    <div class="input-group-append">
                                        <button class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="" id="" class="form-control" v-model="sel_race" @change="get_emp_listing(1)">
                                    <option value="">- Select Race -</option>
                                    <option v-for="r in race" :value="r.code">@{{r.race}}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" v-model="sel_religion" @change="get_emp_listing(1)">
                                    <option value="">-- Select Religion --</option>
                                    <option v-for="(x, index) in religion" :value="x.code">@{{ x.religion }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Race</th>
                                <th>Religion</th>
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
                                <td>@{{e.race}}</td>
                                <td>@{{e.religion}}</td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm">
                                        <a href="javascript:void(0);" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-info" @click="show_modal('edit',e)"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger" @click="delete_data(e.secure_id)"><i class="fas fa-trash"></i></a>
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
        let urlAPI = '{!! base_url().'/api' !!}'

        let dataApp = {
            message: 'Hello Vue!',
            datenow: '',
            
            //modal
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
            limit: [5, 10, 20, 50, 100],
            selected: 10,
            errors: [],
            selectedData: [],
            selected_id: '',
            
            //dropdown list
            race: [],
            religion:[],
            sel_race:'',
            sel_religion:'',
            
            filter_name:'',
            filter_email:'',
        };

        let methodApp = {
            show_date() {
            },
            get_dropdown(){
                let self = this;
                $.get(urlAPI+'/race',function (e){
                    self.race = e;
                });
                $.get(urlAPI+'/religion',function (e){
                    self.religion = e;
                });
            },
            show_modal(proses, data = '') {
                if (proses === 'add') {
                    this.errors = [];
                    this.title_modal = 'Add';
                    this.title_btn_modal = 'Save';
                    this.proses_modal = 'add';
                    this.selectedData = [];
                    this.selected_id = '';
                    this.$refs.formku.reset()
                    $('#show_modal').modal('show');
                }

                if (proses === 'edit') {
                    console.log(data);
                    this.errors = [];
                    this.title_modal = 'Edit';
                    this.title_btn_modal = 'Update';
                    this.proses_modal = 'update';
                    this.selectedData = data;
                    this.selected_id = data.secure_id;
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
                        self.selectedData =[];
                        self.errors=[];
                    }
                });
            },
            delete_data(id) {
                let self = this;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(urlApp + '/delete_data', {del: id}, function (res) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            self.get_emp_listing(1);
                        });
                    }
                })
            },
            get_emp_listing(page = 1) {
                let self = this;
                self.page = page;
                $.post(urlApp, {
                    race: self.sel_race,
                    religion: self.sel_religion,
                    limit: self.selected,
                    page: self.page,
                    search: self.search,
                    filter_name: self.filter_name,
                    filter_email:self.filter_email,
                }, function (res) {
                    self.employee = res.data;
                    self.total_page = res.total_page;
                    self.per_page = res.per_page;
                    self.total_data = res.total_data;
                    self.numbering = ((self.page - 1) * res.per_page);
                    // console.log(self.sel_race);
                });
            },
        };

        let mountedApp = function (e) {
            e.show_date();
            e.get_emp_listing();
            e.get_dropdown();
        }
    </script>
    @include('default.vue-default')
@endsection