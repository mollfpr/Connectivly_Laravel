<template>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Sales Order
					<div class="pull-right">
						<router-link :to="{ name: `salesOrderCreate`}" class="btn btn-primary">
							Create a new order
						</router-link>
					</div>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<br>
						<br>

						<table-component :head="tableLabel" :data="salesOrders.data" :withAction="false"></table-component>
						
						<pagination-component :data="salesOrders" :paginate="paginate"></pagination-component>

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
				salesOrders: {},
				tableLabel: ['customer', 'product', 'quantity', 'total']
			}
		},
		mounted() {
			this.fetch()
		},
		methods: {
			fetch() {
				axios.get('/api/sales-order').then(response => {
					this.salesOrders = response.data;
					this.salesOrders.data = this.salesOrders.data.map(item => {
						return {
							'id'			:	item.id,
							'customer'		:	item.customer.name,
							'product'		:	item.product.name,
							'quantity'		:	item.qty,
							'total'			:	item.qty * item.product.price
						}
					})
				})
			},
			paginate(url) {
				axios.get(url).then(response => {
					this.salesOrders = response.data;
					this.salesOrders.data = this.salesOrders.data.map(item => {
						return {
							'id'			:	item.id,
							'customer'		:	item.customer.name,
							'product'		:	item.product.name,
							'quantity'		:	item.qty,
							'total'			:	item.qty * item.product.price
						}
					})
				})
			}
		}
	}
</script>