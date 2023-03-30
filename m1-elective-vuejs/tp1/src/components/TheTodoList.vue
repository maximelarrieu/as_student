<template>
    <div>
        <div class="container mt-5">
            <div class="table">
                <thead>
                    <tr>
                        <th>A effectuer</th>
                        <th>Temps estimé</th>
                        <th>Responsable</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(task, key) in tasks" :key="key">
                        <td>{{ task.title }}</td>
                        <td>{{ task.hours }} heures</td>
                        <td>{{ task.person }}</td>
                        <td v-bind:style="{ color: computedTaskState }" v-text="computedTaskTextState"></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" @change="selectTask($event, task)">
                                <label class="form-check-label">Select</label>
                            </div>
                            <button type="button" class="btn btn-success" v-on:click="validateTask(task)">Valider</button>
                            <button type="button" class="btn btn-warning ml-1" @click="editTask(task)">Editer</button>
                            <button type="button" class="btn btn-danger ml-1" @click="removeTask(task)">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </div>
        </div>
        <TheTodoInfos :tasks="tasks" :selectedTasks="selectedTasks" />
    </div>
</template>

<script>
import TheTodoInfos from './TheTodoInfos.vue'

export default {
  name: 'TheTodoList',
  props: {
      tasks: Array
  },
  data() {
      return {
          selectedTasks: [],
          selectedTask: {},
          validated: 'green',
          validated_text: 'Validée',
          processing: 'orange',
          processing_text: 'En cours',
          tasksList: this.tasks
      }
  },
  computed: {
      computedTaskState: function() {
          return this.processing
      },
      computedTaskTextState: function() {
          return this.processing_text
      }
  },
  methods: {
      editTask: function(task) {
          console.log(task)
          console.log('selectedTasks', this.selectedTasks)
      },
      removeTask: function(task) {
          const index = this.tasks.indexOf(task)
          this.tasksList.splice(index, 1)
      },
      validateTask: function(task) {
          console.log(task)
          this.processing = this.validated
          this.processing_text = this.validated_text
      },
      selectTask: function(e, task) {
          console.log('event', e.target.checked)
          if(e.target.checked) {
            this.selectedTasks.push(task)
          } else {
            const index = this.selectedTasks.indexOf(task)
            this.selectedTasks.splice(index, 1)
          }
      }
  },
  components: { TheTodoInfos }
}
</script>

<style scoped>
.table {
    width: 70%;
    margin-left: auto;
    margin-right: auto;
}

.validated {
    color: green;
}

.processing {
    color: yellow;
}
</style>
