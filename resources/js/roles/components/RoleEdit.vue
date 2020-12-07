<template>
	<section>
		<div>
			EDITAR ROLES
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="role.name">

                <label>Estado</label>
				<input type="text" v-model="role.status_id">
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
		name: "role-edit-component",
		data() {
			return {				
				role 		:{
                    name: 	'',
                    status_id: ''					
				}
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			},
			roleId: {
				type: Number,
				default: 0
			},
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'RoleList')
			},	
			getRoleById: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/roles/' + this.roleId

				axios
					.get(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							that.role = response.data.data.role
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

				let url = this.base_url + '/api/roles/' + this.roleId

				let data = {
                    name	: this.role.name,
                    status_id	: this.role.status_id
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
			this.getRoleById()
		}
	}
</script>
