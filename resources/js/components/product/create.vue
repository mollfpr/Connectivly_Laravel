<template>
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Product
					<div class="pull-right">
						<router-link :to="{ name: `productList` }" class="btn btn-primary">
							List of Products
						</router-link>
					</div>
                </div>

                <div class="card-body">
					
					<br>
					<br>

					<form v-on:submit.prevent="onSubmit">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" v-model="product.name">
						</div>
						<div class="form-group">
							<label for="price">Price</label>
							<input type="number" class="form-control" v-model="product.price">
						</div>
						<button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
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
				product: {
					name: '',
					price: ''
				}
			}
		},
		methods: {
			onSubmit() {
				let formData = new FormData();
				formData.append('name', this.product.name);
				formData.append('price', this.product.price);
				axios({
					method: 'post',
					url: '/api/product',
					data: formData,
				    config: { headers: {'Content-Type': 'multipart/form-data' }}
				}).then(res => {
					this.$router.push('/product');
				}).catch(e => alert(e.message))
			}
		}
	}
</script>