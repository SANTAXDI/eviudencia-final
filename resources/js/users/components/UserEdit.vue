<template>
	<section>
		<div>
			EDITAR USUARIO
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="user.name">

                <label>Email</label>
				<input type="email" v-model="user.email">

                <label>	Estado</label>
				<input type="text" v-model="user.status_id">

                <label>rol</label>
				<input type="text" v-model="user.role_id">
			</div>
			<div>
				<button @click="edit">Editar</button>
				<button @click="close">Cancelar</button>
			</div>
		</section>			
	</section>
</template>

<script>
	export default {
		name: "user-edit-component",
		data() {
			return {				
				user 		:{
                    name: 	   '',	
                    email:     '',
                    status_id: '',
                    role_id:   ''

				}
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			},
			userId: {
				type: Number,
				default: 0
			},
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'UserList')
			},	
			getUserById: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/users/' + this.userId

				axios
					.get(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							that.user = response.data.data.user
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {						
						alert(error.data.message)
					})
			},
			edit: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/users/' + this.userId

				let data = {
                    name	: this.user.name,
                    email	: this.user.email,
                    status_id	: this.user.status_id,
                    role_id	: this.user.role_id
				}

				axios
					.put(url, data, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {
							alert(response.data.message)
							that.close()
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {						
						alert(error.data.message)
					})
			}
		},
		mounted() {
			this.getUserById()
		}
	}
</script>
