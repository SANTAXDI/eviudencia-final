<template>
	<section>
		<div>
			LISTADO DE ROLES
		</div>
		<div>
			<article>
			
					<div>
						<label>Nombres</label>
						<input type="text" name="name" v-model="name" @keyup.enter="search">
					</div>
					<div>
						<button @click="search">Buscar</button>						
						<button  @click="showComponent('RoleInsert')">Crear</button>
					</div>
							
			</article>

			<article>
				<table>					
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>						
						<tr v-for="role in roleList">
							<td>{{ role.name }}</td>
							<td>{{ role.status_id }}</td>
							<td>
								<button @click="showComponent('RoleEdit',role.id)"> Editar</button>	
								<button @click="deleteRole(role.id)">Eliminar</button>
							</td>
						</tr>
					</tbody>
				</table>	
			</article>
		</div>			
	</section>
</template>

<script>
	export default {
		name: "role-list-component",
		data() {
			return {
				name			:'',
				roleList 	:[],
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			}
		},
		methods: {
			showComponent: function(component,id) {
				this.$emit('onShowComponent', component,id)
			},

			search: function() {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/roles?name=' + this.name

				axios
					.get(url, headers)
					.then((response) => {
						if(response.data.type === 'success') {
							that.roleList = response.data.data
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {
						console.log(error)
					})
			},
			deleteRole: function (id) {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/roles/' + id

				axios
					.delete(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							alert(response.data.message)
							that.search()
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
