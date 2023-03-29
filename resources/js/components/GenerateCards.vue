<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>QR Code Image Generator</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="input-group mb-3">
                    <span class="input-group-text fs-5">Name</span>
                    <input v-model="name" type="text" class="form-control fs-5">
                </div>
            </div>
            <div class="col-12">
                <div class="input-group mb-3">
                    <span class="input-group-text fs-5">LinkedIn URL</span>
                    <input v-model="linkedin" type="text" class="form-control fs-5">
                </div>
            </div>
            <div class="col-12">
                <div class="input-group mb-3">
                    <span class="input-group-text fs-5">Github URL</span>
                    <input v-model="github" type="text" class="form-control fs-5">
                </div>
            </div>
        </div>
        <div>
            <span class="fs-4">Extra info</span>
            <QuillEditor theme="snow" v-model="extra"/>
        </div>
        <div v-if="error" class="row">
            <div class="col">
                <span class="text-danger">{{ error }}</span>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <button @click="generateImage()" type="button" class="btn btn-lg btn-light border-dark border">Generate Image</button>
            </div>
        </div>
    </div>

<div class="modal" id="qr-code" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div v-html="qrcode"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Download QR Code</button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { Modal } from 'bootstrap';

import axios from 'axios';

    export default {
        data() {
            return {
                name: null,
                linkedin: null,
                github: null,
                extra: null,
                error: null,
                modal: null,
                qrcode: null,
            }
        },

        methods: {
            generateImage() {
                axios.post('/api/generate', {
                    name: this.name,
                    github: this.github,
                    linkedin: this.linkedin,
                    extra: this.extra,
                }).then(response => {
                    this.qrcode = atob(response.data['qr-code']);
                    this.modal.show();
                }).catch(error => {
                    this.error = error.response.data.message;
                })
            }
        },

        mounted() {
            this.modal = new Modal('#qr-code');
        }
    }
</script>
