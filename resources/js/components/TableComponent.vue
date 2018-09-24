<template>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th v-for="(item, index) in head">{{ capitalizeFirstLetter(item) }}</th>
				<th v-if="withAction">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(item, index) in data">
				<td v-for="(label, index) in head">{{ item[label] }}</td>
				<td style="width: 125px" v-if="withAction">
					<router-link class="btn btn-warning btn-sm" :to="{ name: pathEdit, params: {id: item.id} }">
						Edit
					</router-link>
					<button class="btn btn-danger btn-sm" @click="onDelete(item.id)">Delete</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props: {
			head: Array,
			data: Array,
			onDelete: Function,
			pathEdit: String,
			withAction: Boolean
		},
		methods: {
			capitalizeFirstLetter(letter) {
			    return letter.charAt(0).toUpperCase() + letter.slice(1);
			}
		}
	}
</script>