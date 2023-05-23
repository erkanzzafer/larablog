<div>
    <div class="page-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <span class="avatar avatar-md" style="background-image: url({{$author->picture}})"></span>
          </div>
          <div class="col">
            <h2 class="page-title">{{$author->name}} | {{$author->authorType->name}}</h2>
            <div class="page-subtitle">
              <div class="row">
                <div class="col-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="3" y1="21" x2="21" y2="21" />
                    <path d="M5 21v-14l8 -4v18" />
                    <path d="M19 21v-10l-6 -4" />
                    <line x1="9" y1="9" x2="9" y2="9.01" />
                    <line x1="9" y1="12" x2="9" y2="12.01" />
                    <line x1="9" y1="15" x2="9" y2="15.01" />
                    <line x1="9" y1="18" x2="9" y2="18.01" />
                  </svg>
                  <a href="#" class="text-reset">{{$author->username}}</a>
                </div>
                <div class="col-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                  </svg>
                  <a href="#" class="text-reset">194 friends</a>
                </div>
                <div class="col-auto text-success">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                  </svg>
                  Verified
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto d-none d-md-flex">
            <input type="file" name="file" id="changeAuthorPictureFile"  class="d-none" onchange="this.dispatchEvent(new InputEvent('input'))">
            <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('changeAuthorPictureFile').click();">
            Change Picture
            </a>
          </div>
        </div>
      </div>
</div>
