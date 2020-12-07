<template>
	<section>
		<div>
			LISTADO DE TIPOS DE ESTATUS
		</div>
		<div>
			<article>
			
					<div>
						<label>Nombres</label>
						<input type="text" name="name" v-model="name" @keyup.enter="search">
					</div>
					<div>
						<button @click="search">Buscar</button>						
						<button  @click="showComponent('TypeStatusInsert')">Crear</button>
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
						<tr v-for="typeStatus in typeStatusList">
							<td>{{ typeStatus.name }}</td>
							<td>
								<button @click="showComponent('TypeStatusEdit',typeStatus.id)"> Editar</button>	
								<button  @click="deleteTypeStatus(typeStatus.id)">Eliminar</button>
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
		name: "typeStatus-list-component",
		data() {
			return {
				name			:'',
				typeStatusList 	:[],
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

				let url = this.base_url + '/api/typeStatuses?name=' + this.name

				axios
					.get(url, headers)
					.then((response) => {
						if(response.data.type === 'success') {
							that.typeStatusList = response.data.data
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {
						console.log(error)
					})
			},
			deleteTypeStatus: function (id) {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/typeStatuses/' + id

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
