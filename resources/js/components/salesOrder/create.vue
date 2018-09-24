<template>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					New Order
					<div class="pull-right">
						<router-link class="btn btn-primary" :to="{ name: 'salesOrderList'}">List of Sales Orders</router-link>
					</div>
				</div>

				<div class="card-body">
					<br>
					<br>

					<form @submit.prevent="onSubmit" id="order-form">
						<div class="form-group">
							<label for="">Customer Name</label>
							<v-select :options="customers" v-model="order.customer"></v-select>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="card">

									<div class="card-body" ref="container">
										<div class="row">
											<div class="col-md-12">
												<div class="pull-right"><a href="javascript:;" class="btn btn-sm btn-success" @click="addRow()">Add Product</a></div>
												<br>
												<hr>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<br>

						<button type="submit" class="btn btn-primary">Submit</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Vue from 'vue';
	import vSelect from 'vue-select';
	import ItemComponent from '../ItemComponent';

	export default {
		components: {
			vSelect,
			ItemComponent
		},
		data() {
			return {
				customers: '',
				products: '',
				rowIndex: 0,
				order: {
					customer: '',
					items: []
				}
			}
		},
		mounted() {
			this.fetchCustomers();
			this.fetchProducts();
		},
		methods: {
			fetchCustomers() {
				axios.get('/api/customers').then(response => {
					this.customers = response.data;
				});
			},

			fetchProducts() {
				axios.get('/api/products').then(response => {
					this.products = response.data;
				});
			},

			onSubmit() {
				this.order.items = [];

				for (var i = 1; i <= this.rowIndex; i++) {
					let product_id = $(`#product_${i}`).val();
					let qty = $(`#qty_${i}`).val();
					if (product_id || qty) {
						this.order.items.push({
							product_id,
							qty
						});
					}
				}

				axios({
					method: 'post',
					url: '/api/sales-order',
					data: {
						order: this.order
					},
					config: { headers: {'Content-Type': 'multipart/form-data' }}
				}).then(response => {
					alert(response.data.success);
					this.$router.push('/sales-order');
				}).catch(err => {
					alert(err);
				})
			},

			addRow() {
				this.rowIndex++;
				let ComponentClass = Vue.extend(ItemComponent);
				let instance = new ComponentClass({
					propsData: { index: this.rowIndex, products: this.products, deleteRow: this.deleteRow }
				});
				instance.$mount();
				this.$refs.container.appendChild(instance.$el);
			},

			deleteRow(index) {
				let child = document.getElementById(index);
				this.$refs.container.removeChild(child);
			},
		}
	}
</script>