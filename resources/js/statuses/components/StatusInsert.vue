<template>
	<section>
		<div>
			NUEVO ESTATUS
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="name">
                <label>Type de Estatus</label>
				<input type="text" v-model="type_status_id">
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
		name: "status-insert-component",
		data() {
			return {
                name			:'',
                type_status_id  :'',			
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
				this.$emit('onShowComponent', 'StatusList')
			},		
			insert: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/statuses'

				let data = {
                    name	:this.name,
                    type_status_id   :this.type_status_id
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
