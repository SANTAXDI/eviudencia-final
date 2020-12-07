<template>
	<section>
		<div>
			NUEVO USUARIO
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="name">
                
                <label>Email</label>
				<input type="email" v-model="email">
                
                <label>Contraseña</label>
				<input type="password" v-model="password">

                <label>rol</label>
				<input type="text" v-model="role_id">

			</div>
			<div>
				<button @click="insert">Guardar</button>
				<button @click="close">Cancelar</button>
			</div>
		</section>			
	</section>
</template>

<script>
	export default {
		name: "user-insert-component",
		data() {
			return {
                name			:'',
                email           :'',
                password		:'',
                role_id         :''
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			}
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'UserList')
			},		
			insert: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/users'

				let data = {
                    name	        :this.name,
                    email           :this.email,
                    password		:this.password,
                    role_id         :this.role_id
				}

				axios
					.post(url, data, headers)
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
		}
	}
</script>
