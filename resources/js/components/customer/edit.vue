<template>
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Customer: <b>{{ customer.name }}</b>
					<div class="pull-right">
						<router-link :to="{ name: `customerList`}" class="btn btn-primary">
							List of Customers
						</router-link>
					</div>
                </div>

                <div class="card-body">
					
					<br>
					<br>

					<form v-on:submit.prevent="onSubmit">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" v-model="customer.name">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" v-model="customer.email">
						</div>
						<div class="form-group">
							<label for="address">Address</label>
							<textarea name="" id="" cols="30" rows="5" class="form-control" v-model="customer.address"></textarea>
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
				customer: {
					name: '',
					email: '',
					address: ''
				}
			}
		},
		mounted() {
			axios.get(`/api/customer/${this.$route.params.id}`).then(res => {
				this.customer.name = res.data.name;
				this.customer.email = res.data.email;
				this.customer.address = res.data.address;
			})
		},
		methods: {
			onSubmit() {
				axios({
					method: 'put',
					url: `/api/customer/${this.$route.params.id}`,
					data: {
						name: this.customer.name,
						email: this.customer.email,
						address: this.customer.address
					},
				    config: { headers: {'Content-Type': 'multipart/form-data' }}
				}).then(res => {
					this.$router.push('/customer');
				}).catch(e => alert(e.message))
			}
		}
	}
</script>