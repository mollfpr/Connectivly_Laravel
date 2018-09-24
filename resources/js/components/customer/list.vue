<template>
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer
					<div class="pull-right">
						<router-link :to="{ name: `customerCreate`}" class="btn btn-primary">
							Create a new customer
						</router-link>
					</div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
						<br>
						<br>
						
						<table-component :head="tableLabel" :data="customers.data" pathEdit="customerEdit" :onDelete="onDelete" :withAction="true"></table-component>

						<pagination-component :data="customers" :paginate="paginate"></pagination-component>
						
					</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import TableComponent from '../TableComponent';
	import PaginationComponent from '../PaginationComponent';

	export default {
		components: {
			TableComponent,
			PaginationComponent
		},
		data() {
			return {
				customers: {},
				tableLabel: ['name', 'email', 'address']
			}
		},
		mounted() {
			this.fetch()
		},
		methods: {
			fetch() {
				axios.get('/api/customer').then(response => {
					this.customers = response.data;
				});
			},
			paginate(url) {
				axios.get(url).then(response => {
					this.customers = response.data;
				})
			},
			onDelete:function (id) {
				axios.delete(`/api/customer/${id}`).then(res => {
					this.fetch();
				})
			}
		}
	}
</script>