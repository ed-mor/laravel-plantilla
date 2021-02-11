<template>
	<img :src="logo">
</template>

<script>
	export default {
		data(){
			return{
				logo: 'http://localhost:8000/images/logo.png'
			}
		}
	}	
</script>