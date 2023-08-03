import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LogoComponent } from './logo/logo.component';
import { IonicModule } from '@ionic/angular';
import { FooterComponent } from './footer/footer.component';



@NgModule({
  declarations: [
    LogoComponent,
    FooterComponent
  ],
  imports: [
    CommonModule,
    IonicModule
  ],
  exports: [
    LogoComponent,
    FooterComponent
  ]
})
export class ComponentesModule { }
