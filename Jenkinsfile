parallel(
    "7.1" : {
        node('dind') {
            docker.image('php:7.1.2-cli').inside {
		stage("Build") {
                	sh 'make build'
		}
		stage("Test") {
			sh 'make test'
		}
            }
        }
    },
    "7.0" : {
        node('dind') {
            docker.image('php:7.0.16-cli').inside {
		stage("Build") {
                	sh 'make build'
		}
		stage("Test") {
			sh 'make test'
		}
            }
        }
    },
    "5.6" : {
        node('dind') {
            docker.image('php:5.6.30-cli').inside {
		stage("Build") {
                	sh 'make build'
		}
		stage("Test") {
			sh 'make test'
		}
            }
        }
    }
)

