<template>
    <form method="POST" action="/document" class="form" @submit="onSubmit">
        <input type="hidden" name="_token" :value="csrf">
        <div class="form-group">
            <label for="doc_title">Document name</label>
            <input type="text" id="doc_title" name="doc_name" class="form-control" v-model="doc_name">
        </div>
        <div class="form-group">
            <div class="form-check" v-for="(type) in types">
                <input type="radio" :id="'doc_type_' + type.id" name="doc_type" :value="type.id" class="form-check-input" v-model="doc_type">
                <label :for="'doc_type_' + type.id" class="form-check-label">{{type.name}}</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" :disabled="isDisabled">Create document</button>
    </form>
</template>
<script>
    const TYPES = [
        {
            id: 1,
            name: 'Analytical Essay/Report'
        },
        {
            id: 2,
            name: 'Reflective Journal/Report'
        },
        {
            id: 10,
            name: 'Research Abstract'
        },
        {
            id: 5,
            name: 'Research Introduction'
        }
    ];

    export default {
        props: ['csrf'],
        data() {
            return {
                types: TYPES,
                doc_name: '',
                doc_type: null
            };
        },
        methods: {
            onSubmit() {
                if (!(this.doc_name && this.doc_type)) {
                    return false;
                }
                for (let type of TYPES) {
                    if (type.id === this.doc_type) {
                        window.trackEvent('Document', 'create', type.name);
                        break;
                    }
                }
            },
        },
        computed: {
            isDisabled() {
                return !(this.doc_name && this.doc_type);
            }
        }
    }
</script>
