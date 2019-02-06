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
import { DashboardComponent } from './Components/dashboard/dashboard.component';
import { AuthGuard } from './auth.guard';
import { AuthInterceptor } from './auth.interceptor';
import { FooterComponent } from './Components/footer/footer.component';

/* esto es util solo para el momento de desarrollar*/
//import {platformBrowserDynamic} from '@angular/platform-browser-dynamic';

const routes:Routes = [
	{path: '', redirectTo: 'home', pathMatch: 'full'},
	{path: 'login', component: LoginComponent},
	{path: 'home', component: HomeComponent,canActivate:[AuthGuard]},
  {path: 'signup', component: SignUpComponent},
  {path: 'dashboard', component: DashboardComponent,canActivate:[AuthGuard]}, 
	// {path: '**', component: HomeComponent} 
];



@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HeaderComponent,
    HomeComponent,
    SignUpComponent,
    DashboardComponent,
    FooterComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    HttpClientModule,
    ReactiveFormsModule,
    RouterModule.forRoot(
      routes,
      { enableTracing: true ,useHash: true}
    )
  ],
  providers: [{
    provide : HTTP_INTERCEPTORS,
    useClass : AuthInterceptor,
    multi : true
  }],
  bootstrap: [AppComponent]
})
export class AppModule { }

/*Comentar en produccion */
// platformBrowserDynamic().bootstrapModule(AppModule);