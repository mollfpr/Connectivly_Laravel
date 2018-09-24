<template>
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer: <b>{{ customer.name }}</b>
					<div class="pull-right">
						<router-link :to="{ name: `customerList`}" class="btn btn-primary">
							List of Customers
						</router-link>
					</div>
                </div>

                <div class="card-body">
                	<h1>{{ customer.name }}</h1>
                	<div class="row">
                		<div class="col-md-12">
	                		<span>Email: <b>{{ customer.email }}</b></span>
	                	</div>
                	</div>
                	<div class="row">
                		<div class="col-md-12">
	                		<span>Address: <b>{{ customer.address }}</b></span>
	                	</div>
                	</div>
                	<br>
                	<div class="row">
                		<div class="col-md-12">
	                		<router-link :to="{ name: `customerEdit`, params: {id: $route.params.id} }" class="btn btn-warning btn-sm">Edit</router-link>
	                		<button class="btn btn-danger btn-sm" v-on:click="onDelete()">Delete</button>
	                	</div>
                	</div>
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
			onDelete() {
				axios.delete(`/api/customer/${this.$route.params.id}`).then(res => {
					this.$router.push({name: `customerList`});
				})
			}
		}
	}
</script>