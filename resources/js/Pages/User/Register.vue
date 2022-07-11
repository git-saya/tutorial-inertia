<template>
	<Layout v-bind:title="title">
		<h1>Register</h1>
		<form @submit.prevent="register">
			<div class="form-group">
				<label>Name</label>
				<input type="text" v-model="user.name">
				<p v-if="errors.name" class="error">{{ errors.name }}</p>
			</div>

			<div class="form-group">
				<label>Email</label>
				<input type="text" v-model="user.email">
				<p v-if="errors.email" class="error">{{ errors.email }}</p>
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" v-model="user.password">
				<p v-if="errors.password" class="error">{{ errors.password }}</p>
			</div>

			<button type="submit">Register</button>
		</form>
	</Layout>
</template>

<script>
	import Layout from '../../Shared/Layout.vue'

	export default {
		components: {
			Layout
		},
		data() {
			return {
				user: {
					name: '',
					email: '',
					password: ''
				}
			}
		},
		props: {
			title: String,
			errors: Object
		},
		methods: {
			register() {
				this.$inertia.post('/users', this.user)
			}
		}
	}	
</script>

<style>
	.form-group {
		margin-bottom: 5px
	}

	.error {
		color: red
	}
</style>