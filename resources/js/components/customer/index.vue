<style>
	.fade-enter-active, .fade-leave-active {
	  transition: opacity .5s;
	}
	.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	  opacity: 0;
	}
</style>

<template>
	<router-view></router-view>
</template>

<script>
	export default {
		
	}
</script>