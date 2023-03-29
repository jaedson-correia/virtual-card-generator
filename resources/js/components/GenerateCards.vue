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
            <QuillEditor ref="editor" theme="snow" contentType="html" v-model:content="extra"/>
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
                <h5 class="modal-title">QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                <canvas width="200" height="200" class="d-none"></canvas>
                <div>
                    <h4>{{ card ? card.name : '' }}</h4>
                </div>
                <div v-html="qrcode"></div>
            </div>
            <div class="modal-footer">
                <button @click="download()" type="button" class="btn btn-primary">Download QR Code</button>
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
                card: null,
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
                    this.card = response.data.card;
                    this.qrcode = atob(response.data['qr-code']);
                    this.modal.show();
                    this.reset();
                }).catch(error => {
                    this.error = error.response.data.message;
                })
            },

            download() {
                // getting svg and placing it on canvas to download
                let svg = document.querySelector('.modal svg');
                let canvas = document.querySelector('canvas');
                let ctx = canvas.getContext('2d');
                let data = (new XMLSerializer()).serializeToString(svg);
                let DOMURL = window.URL || window.webkitURL || window;

                let img = new Image();
                let svgBlob = new Blob([data], {type: 'image/svg+xml;charset=utf-8'});
                let url = DOMURL.createObjectURL(svgBlob);

                img.onload = function () {
                    ctx.drawImage(img, 0, 0);
                    DOMURL.revokeObjectURL(url);

                    let imgURI = canvas
                        .toDataURL('image/png')
                        .replace('image/png', 'image/octet-stream');

                        let evt = new MouseEvent('click', {
                            view: window,
                            bubbles: false,
                            cancelable: true
                        });

                        let a = document.createElement('a');
                        a.setAttribute('download', 'qr-code.png');
                        a.setAttribute('href', imgURI);
                        a.setAttribute('target', '_blank');

                        a.dispatchEvent(evt);
                };

                img.src = url;
            },

            reset() {
                this.name = null;
                this.linkedin = null;
                this.github = null;
                this.extra = null;
                this.error = null;
                this.$refs.editor.setHTML('');
            }
        },

        mounted() {
            this.modal = new Modal('#qr-code');
        }
    }
</script>
