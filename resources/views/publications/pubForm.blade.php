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

    <div class="col l8 offset-l2">
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
                  <p>Mounir RM</p>
                  <p style="margin:0;">
                    <input name="colab2" type="radio" id="any2"></input>
                    <label for="any2" style="top:0;">Any</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab2" type="radio" id="publicator2"></input>
                    <label for="publicator2" style="top:0;">Publicator</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab2" type="radio" id="editor2"></input>
                    <label for="editor2" style="top:0;">Editor</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab2" type="radio" id="mediamanager2"></input>
                    <label for="mediamanager2" style="top:0;">Media Manager</label>
                  </p>
                </div>

                <div class="col s6 l4">
                  <p>Mohamed MC</p>
                  <p style="margin:0;">
                    <input name="colab3" type="radio" id="any3"></input>
                    <label for="any3" style="top:0;">Any</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab3" type="radio" id="publicator3"></input>
                    <label for="publicator3" style="top:0;">Publicator</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab3" type="radio" id="editor3"></input>
                    <label for="editor3" style="top:0;">Editor</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab3" type="radio" id="mediamanager3"></input>
                    <label for="mediamanager3" style="top:0;">Media Manager</label>
                  </p>
                </div>

                <div class="col s6 l4">
                  <p>Lotfi BA</p>
                  <p style="margin:0;">
                    <input name="colab4" type="radio" id="any4"></input>
                    <label for="any4" style="top:0;">Any</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab4" type="radio" id="publicator4"></input>
                    <label for="publicator4" style="top:0;">Publicator</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab4" type="radio" id="editor4"></input>
                    <label for="editor4" style="top:0;">Editor</label>
                  </p>
                  <p style="margin:0;">
                    <input name="colab4" type="radio" id="mediamanager4"></input>
                    <label for="mediamanager4" style="top:0;">Media Manager</label>
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
