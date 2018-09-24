<template>
	<div class="row justify-content-center align-items-center row-margin" :id="index">
		<div class="col-md-8">
			<v-select :options="products" v-model="product"></v-select>
			<input type="hidden" v-model="product.value" :id="`product_${index}`">
		</div>
		<div class="col-md-3">
			<input type="number" v-model="qty" class="form-control" :id="`qty_${index}`" placeholder="Quantity">
		</div>
		<div class="col-md-1">
			<button class="btn btn-danger" @click="deleteRow(index)"><span class="text-center">-</span></button>
		</div>
	</div>
</template>

<script>
	import vSelect from 'vue-select';

	export default {
		components: {
			vSelect
		},
		props: {
			index: Number,
			products: Array,
			deleteRow: Function
		},
		data() {
			return {
				product: '',
				qty: ''
			}
		},
	}
</script>

<style>
	.row-margin {
		margin: 5px 0;
	}
</style>