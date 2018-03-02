<template>
	<div v-show="preloader" class="preloader">
        <img src="/img/preloader.gif" alt="Preloader..." class="preloader">
	</div>
</template>

<script>
export default {
	computed: {
		preloader () {
			return this.$store.state.preloader.loading
		}
	}
}
</script>

<style scoped>
.preloader{
    text-align: center;
    background: #262626;
    color: #FFF;
    /* padding: 28%; */
    position: absolute;
    z-index: 9999;
    opacity: .4;
    top: 0;
    width: 100%;
    left: 0;
    height: 100%;
    text-align: center;
}
img.preloader{
    width: 274px;
    height: auto;
    max-width: 100%;
    position: relative;
}
</style>