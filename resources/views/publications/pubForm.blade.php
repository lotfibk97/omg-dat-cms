@extends('layouts.base')


@section('style')

@stop

@section('script')

@stop


@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2> Edit your publication </h2>
  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1">

    <div class="col s8 offset-s2">
      <div class="card-panel">

        <div class="row">
          <form class="col s12">

            <div class="row">
              <div class="input-field col s12">
                <input id="title" type="text" name="title">
                <label for="title">Title</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <textarea id="description" name="description" class="materialize-textarea"></textarea>
                <label for="description">Description</label>
              </div>
            </div>

            <div class="container">
              <div class="input-field col s12">

                <div class="col s6 l4">
                  <p>Lotfi BK</p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="any1"></input>
                    <label for="any1" style="top:0;">Any</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="publicator1"></input>
                    <label for="publicator1" style="top:0;">Publicator</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="editor1"></input>
                    <label for="editor1" style="top:0;">Editor</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="mediamanager1"></input>
                    <label for="mediamanager1" style="top:0;">Media Manager</label>
                  </p>
                </div>

                <div class="col s6 l4">
                  <p>Lotfi BK</p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="any1"></input>
                    <label for="any1" style="top:0;">Any</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="publicator1"></input>
                    <label for="publicator1" style="top:0;">Publicator</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="editor1"></input>
                    <label for="editor1" style="top:0;">Editor</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="mediamanager1"></input>
                    <label for="mediamanager1" style="top:0;">Media Manager</label>
                  </p>
                </div>

                <div class="col s6 l4">
                  <p>Lotfi BK</p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="any1"></input>
                    <label for="any1" style="top:0;">Any</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="publicator1"></input>
                    <label for="publicator1" style="top:0;">Publicator</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="editor1"></input>
                    <label for="editor1" style="top:0;">Editor</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="mediamanager1"></input>
                    <label for="mediamanager1" style="top:0;">Media Manager</label>
                  </p>
                </div>

                <div class="col s6 l4">
                  <p>Lotfi BK</p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="any1"></input>
                    <label for="any1" style="top:0;">Any</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="publicator1"></input>
                    <label for="publicator1" style="top:0;">Publicator</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="editor1"></input>
                    <label for="editor1" style="top:0;">Editor</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab1" type="radio" id="mediamanager1"></input>
                    <label for="mediamanager1" style="top:0;">Media Manager</label>
                  </p>
                </div>

              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                  <i class="mdi-content-send right"></i>
                </button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>

@stop
