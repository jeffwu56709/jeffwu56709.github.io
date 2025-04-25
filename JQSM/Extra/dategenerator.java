import java.util.Random;

class Main {
    public static void main(String[] args) {
        Random r= new Random();
        int r1,r2,r3,r4;
        String ran1,ran2,ran3,ran4;
        for(int i=0;i<44;i++){
            r1 = r.nextInt(12);
            if(r1<10){
                 ran1 = String.format("%02d", r1+1);
            }
            else{
                ran1 = Integer.toString(r1+1);
            }
            r2 = r.nextInt(28);
            if(r2<10){
                 ran2 = String.format("%02d", r2+1);
            }
            else{
                ran2 = Integer.toString(r2+1);
            }
            r3 = r.nextInt(24);
            if(r3<10){
                 ran3 = String.format("%02d", r3);
            }
            else{
                ran3 = Integer.toString(r3);
            }
            r4 = r.nextInt(60);
            if(r4<10){
                 ran4 = String.format("%02d", r4);
            }
            else{
                ran4 = Integer.toString(r4);
            }
            System.out.println("2023-"+ran1+"-"+ran2+" "+ran3+":"+ran4);
        }
    }
}
