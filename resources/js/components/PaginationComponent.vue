<template>
	<ul class="pagination">
		<li v-if="data.prev_page_url">
			<a @click.prevent="paginate(data.prev_page_url)" :href="data.prev_page_url">&laquo; Previous</a>
		</li>
		<li v-if="data.next_page_url">
			<a @click.prevent="paginate(data.next_page_url)" :href="data.next_page_url">Next &raquo;</a>
		</li>
	</ul>
</template>

<script>
	export default {
		props: {
			paginate: Function,
			data: Object
		}
	}
</script>