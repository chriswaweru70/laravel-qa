<template>
	<div>
		<div class="card-body">
			<div v-if="questions.length">
				<question-excerpt
					@deleted="remove(index)"
					v-for="(question,index) in questions"
					:question="question"
					:key="question.id"
				></question-excerpt>
			</div>
			<div v-else class="alert alert-warning">
				<strong>Sorry!!</strong> There are no questions available.
			</div>
		</div>
		<div class="card-footer">
			<pagination :meta="meta" :links="links"></pagination>
		</div>
	</div>
</template>

<script>
import QuestionExcerpt from '../components/QuestionExcerpt.vue'
import Pagination from '../components/Pagination.vue'

export default {
	components: { QuestionExcerpt, Pagination },

	data() {
		return {
			questions: [],
			meta: {},
			links: {}
		}
	},
	mounted() {
		this.fetchQuestions()
	},
	methods: {
		fetchQuestions() {
			axios
				.get('/questions', { params: this.$route.query })
				.then(({ data }) => {
					this.questions = data.data
					this.meta = data.meta
					this.links = data.links
				})
		},
		remove(index) {
			this.questions.splice(index, 1)
			this.count--
		}
	},
	watch: {
		$route: 'fetchQuestions'
	}
}
</script>