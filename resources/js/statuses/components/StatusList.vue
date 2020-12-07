<template>
	<section>
		<div>
			LISTADO DE ESTATUS
		</div>
		<div>
			<article>
			
					<div>
						<label>Nombres</label>
						<input type="text" name="name" v-model="name" @keyup.enter="search">
					</div>
					<div>
						<button @click="search">Buscar</button>						
						<button  @click="showComponent('StatusInsert')">Crear</button>
					</div>
							
			</article>

			<article>
				<table>					
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Tipo de Estatus</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>						
						<tr v-for="status in statusList">
							<td>{{ status.name }}</td>
							<td>{{ status.type_status_id }}</td>
							<td>
								<button @click="showComponent('StatusEdit', status.id)"> Editar</button>	
								<button @click="deleteStatus(status.id)">Eliminar</button>
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
		name: "status-list-component",
		data() {
			return {
				name			:'',
				statusList 	:[],
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

				let url = this.base_url + '/api/statuses?name=' + this.name

				axios
					.get(url, headers)
					.then((response) => {
						if(response.data.type === 'success') {
							that.statusList = response.data.data
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {
						console.log(error)
					})
			},
			deleteStatus: function (id) {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/statuses/' + id

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
