<template>
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product
					<div class="pull-right">
						<router-link :to="{ name: `productCreate`}" class="btn btn-primary">
							Create a new product
						</router-link>
					</div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
						<br>
						<br>
						
						<table-component :head="tableLabel" :data="products.data" pathEdit="productEdit" :onDelete="onDelete" :withAction="true"></table-component>

						<pagination-component :data="products" :paginate="paginate"></pagination-component>

					</div>
                </div>
            </div>
        </div>
    </div>
	
</template>

<script>
	import TableComponent from '../TableComponent'
	import PaginationComponent from '../PaginationComponent'

	export default {
		components: {
			TableComponent,
			PaginationComponent
		},
		data() {
			return {
				products: {},
				tableLabel: ['code', 'name', 'price']
			}
		},
		mounted() {
			this.fetch()
		},
		methods: {
			fetch() {
				axios.get('/api/product').then(response => {
					this.products = response.data;
				});
			},
			paginate(url) {
				axios.get(url).then(response => {
					this.products = response.data;
				})
			},
			onDelete:function (id) {
				axios.delete(`/api/product/${id}`).then(res => {
					this.fetch();
				})
			}
		}
	}
</script>