import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import {
  ReactiveFormsModule,
  FormsModule
} from '@angular/forms';
import { HttpModule } from '@angular/http';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { LoginComponent } from './Components/content/login/login.component';
import { HeaderComponent } from './Components/header/header.component';
import { HomeComponent } from './Components/content/home/home.component';
import { RouterModule, Routes } from '@angular/router';
import { SignUpComponent } from './Components/content/sign-up/sign-up.component';
import { UserListComponent } from './Components/content/users/user-list/user-list.component';
import { AuthGuard } from './auth.guard';
import { AuthInterceptor } from './auth.interceptor';
import { FooterComponent } from './Components/footer/footer.component';
import { UserDetailComponent } from './Components/content/users/user-detail/user-detail.component';
import { UserComponent } from './Components/content/users/user-list/user/user.component';
import { SearchUserComponent } from './Components/content/users/user-list/search-user/search-user.component';

/* esto es util solo para el momento de desarrollar*/
//import {platformBrowserDynamic} from '@angular/platform-browser-dynamic';

const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'login', component: LoginComponent },
  { path: 'home', component: HomeComponent, canActivate: [AuthGuard] },
  { path: 'signup', component: SignUpComponent },
  {
    path: 'user',
    component: UserListComponent,
    canActivate: [AuthGuard],
    // children: [
    //   {path: 'new', component: UserDetailComponent ,canActivate: [AuthGuard] },
    //   {path: 'edit/:id', component: UserDetailComponent, canActivate: [AuthGuard] }, 
    //   {path: 'edit', redirectTo: "./user", pathMatch: "full"  }, 
    // ]
  },
  {path: 'user/new', component: UserDetailComponent ,canActivate: [AuthGuard] },
  {path: 'user/edit/:id', component: UserDetailComponent, canActivate: [AuthGuard] }, 
  {path: 'user/edit', redirectTo: "user", pathMatch: "full"  }, 
  // {path: '**', component: HomeComponent} 
];



@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HeaderComponent,
    HomeComponent,
    SignUpComponent,
    FooterComponent,
    UserListComponent,
    UserDetailComponent,
    SearchUserComponent,
    UserComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    HttpClientModule,
    ReactiveFormsModule,
    RouterModule.forRoot(
      routes,
      { enableTracing: true, useHash: true }
    )
  ],
  providers: [{
    provide: HTTP_INTERCEPTORS,
    useClass: AuthInterceptor,
    multi: true
  }],
  bootstrap: [AppComponent]
})
export class AppModule { }

/*Comentar en produccion */
// platformBrowserDynamic().bootstrapModule(AppModule);