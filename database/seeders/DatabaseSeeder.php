<?php

namespace Database\Seeders;

use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * call this cmd 
     * php artisan db:seed
     *
     * @return void
     */
    public function run()
    {   
        // add users 
        //date_default_timezone_set('Africa/Casablanca');
        // $postId1 = 2;
        // $postId2 = 3;
        // $list = [
        //     [
        //     'name' => "Ibrahim",
        //     'email' => "inoods0@mit.edu",
        //     'gender' => "female",
        //     'mobile' => "9214688892",
        //     'birth_date' => "1990/06/05",
        //     'adress' => "306 Bobwhite Terrace",
        //     'about' => "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.\n\nFusce consequat. Nulla nisl. Nunc nisl.",
        //     'quote' => "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros."
        //     ],
        //   // [
        //   //   'name' => "Donnamarie",
        //   //   'email' => "dwasylkiewicz1@bing.com",
        //   //   'gender' => "male",
        //   //   'mobile' => "4388664328",
        //   //   'birth_date' => "1992/03/12",
        //   //   'adress' => "6 Comanche Lane",
        //   //   'about' => "In congue. Etiam justo. Etiam pretium iaculis justo.",
        //   //   'quote' => "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.\n\nIn sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus."
        //   //   ], [
        //   //   'name' => "Minny",
        //   //   'email' => "mlansbury2@hao123.com",
        //   //   'gender' => "male",
        //   //   'mobile' => "7779603802",
        //   //   'birth_date' => "1999/12/28",
        //   //   'adress' => "2 Armistice Crossing",
        //   //   'about' => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
        //   //   'quote' => "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem."
        //   // ], [
        //   //   'name' => "Jenilee",
        //   //   'email' => "jeisig3@dagondesign.com",
        //   //   'gender' => "male",
        //   //   'mobile' => "6439547489",
        //   //   'birth_date' => "1994/07/15",
        //   //   'adress' => "284 Hanover Drive",
        //   //   'about' => "Sed ante. Vivamus tortor. Duis mattis egestas metus.\n\nAenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
        //   //   'quote' => "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus."
        //   // ], 
        //   [
        //     'name' => "Barbi",
        //     'email' => "bhumphery4@nytimes.com",
        //     'gender' => "female",
        //     'mobile' => "1915634243",
        //     'birth_date' => "1997/06/24",
        //     'adress' => "3 John Wall Crossing",
        //     'about' => "Phasellus in felis. Donec semper sapien a libero. Nam dui.\n\nProin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
        //     'quote' => "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros."
        //   ], 
        //   [
        //     'name' => "Stanislas",
        //     'email' => "sbamforth5@csmonitor.com",
        //     'gender' => "female",
        //     'mobile' => "3115187303",
        //     'birth_date' => "1994/05/29",
        //     'adress' => "8 Twin Pines Terrace",
        //     'about' => "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
        //     'quote' => "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh."
        //   ], [
        //     'name' => "Matti",
        //     'email' => "mryding6@joomla.org",
        //     'gender' => "male",
        //     'mobile' => "7346004216",
        //     'birth_date' => "1995/09/22",
        //     'adress' => "6076 Mallory Place",
        //     'about' => "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.\n\nCurabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
        //     'quote' => "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat."
        //   ], [
        //     'name' => "Sianna",
        //     'email' => "ssloegrave7@weibo.com",
        //     'gender' => "male",
        //     'mobile' => "8903877132",
        //     'birth_date' => "1993/07/09",
        //     'adress' => "46679 Memorial Plaza",
        //     'about' => "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
        //     'quote' => "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus."
        //   ],
        //    //[
        //   //   'name' => "Kizzie",
        //   //   'email' => "kcholdcroft8@unblog.fr",
        //   //   'gender' => "male",
        //   //   'mobile' => "2655119458",
        //   //   'birth_date' => "1992/02/13",
        //   //   'adress' => "34598 Tennessee Center",
        //   //   'about' => "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.\n\nMaecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
        //   //   'quote' => "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris."
        //   // ], [
        //   //   'name' => "Borg",
        //   //   'email' => "bolerenshaw9@last.fm",
        //   //   'gender' => "male",
        //   //   'mobile' => "4447241420",
        //   //   'birth_date' => "1991/06/15",
        //   //   'adress' => "77187 Hayes Pass",
        //   //   'about' => "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
        //   //   'quote' => "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus."
        //   // ], 
        //   // [
        //   //   'name' => "Oliver",
        //   //   'email' => "odallasa@mac.com",
        //   //   'gender' => "female",
        //   //   'mobile' => "5773903699",
        //   //   'birth_date' => "1996/09/07",
        //   //   'adress' => "67 Elmside Drive",
        //   //   'about' => "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
        //   //   'quote' => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis."
        //   // ], [
        //   //   'name' => "Bernie",
        //   //   'email' => "bsimnettb@lycos.com",
        //   //   'gender' => "female",
        //   //   'mobile' => "9812044125",
        //   //   'birth_date' => "1991/08/14",
        //   //   'adress' => "5 Cody Terrace",
        //   //   'about' => "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
        //   //   'quote' => "Phasellus in felis. Donec semper sapien a libero. Nam dui.\n\nProin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius."
        //   // ], [
        //   //   'name' => "Christel",
        //   //   'email' => "cglennonc@google.es",
        //   //   'gender' => "female",
        //   //   'mobile' => "6488482757",
        //   //   'birth_date' => "1997/06/09",
        //   //   'adress' => "1 Darwin Place",
        //   //   'about' => "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.\n\nProin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
        //   //   'quote' => "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl."
        //   // ], [
        //   //   'name' => "Rinaldo",
        //   //   'email' => "rdarintond@w3.org",
        //   //   'gender' => "male",
        //   //   'mobile' => "9418610789",
        //   //   'birth_date' => "1994/12/18",
        //   //   'adress' => "0 Grayhawk Drive",
        //   //   'about' => "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
        //   //   'quote' => "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est."
        //   // ], [
        //   //   'name' => "Selinda",
        //   //   'email' => "struine@geocities.jp",
        //   //   'gender' => "male",
        //   //   'mobile' => "9809881278",
        //   //   'birth_date' => "1998/01/19",
        //   //   'adress' => "38 Helena Avenue",
        //   //   'about' => "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
        //   //   'quote' => "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus."
        //   // ], [
        //   //   'name' => "Kelila",
        //   //   'email' => "kluesleyf@marketwatch.com",
        //   //   'gender' => "female",
        //   //   'mobile' => "1479463274",
        //   //   'birth_date' => "1999/01/07",
        //   //   'adress' => "5841 Acker Terrace",
        //   //   'about' => "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
        //   //   'quote' => "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl."
        //   // ], [
        //   //   'name' => "Adel",
        //   //   'email' => "adulintyg@feedburner.com",
        //   //   'gender' => "male",
        //   //   'mobile' => "8704098840",
        //   //   'birth_date' => "1994/12/07",
        //   //   'adress' => "07505 Pepper Wood Parkway",
        //   //   'about' => "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
        //   //   'quote' => "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.\n\nProin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem."
        //   // ], [
        //   //   'name' => "Orton",
        //   //   'email' => "owinridgeh@opensource.org",
        //   //   'gender' => "female",
        //   //   'mobile' => "8573069848",
        //   //   'birth_date' => "1998/04/23",
        //   //   'adress' => "7 Badeau Drive",
        //   //   'about' => "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
        //   //   'quote' => "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros."
        //   // ], [
        //   //   'name' => "Nicoline",
        //   //   'email' => "nhuski@linkedin.com",
        //   //   'gender' => "male",
        //   //   'mobile' => "5596726990",
        //   //   'birth_date' => "1995/06/16",
        //   //   'adress' => "8 Oriole Plaza",
        //   //   'about' => "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
        //   //   'quote' => "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat."
        //   // ], [
        //   //   'name' => "Halsey",
        //   //   'email' => "hbelchamj@bbb.org",
        //   //   'gender' => "female",
        //   //   'mobile' => "8001615011",
        //   //   'birth_date' => "1997/01/23",
        //   //   'adress' => "39642 Porter Center",
        //   //   'about' => "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
        //   //   'quote' => "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque."
        //   // ]
        //   ];
        // for ($i=1; $i < count($list); $i++) { 
        //     $userId = $i;
        //     $postId = [$postId1,$postId2];
        //     // $name = Str::random(10);
        //     $user = User::create([
        //         'name' => $list[$i]['name'],
        //         'email' => $list[$i]['email'],
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         'mobile' => $list[$i]['mobile'],
        //         'adress' => $list[$i]['adress'],
        //         'website' => 'https://www.google.com/', 
        //         'birth_date' => date($list[$i]['birth_date']),
        //         'gender' => $list[$i]['gender'],
        //         'facebook' => 'https://web.facebook.com/',
        //         'twitter' => 'https://twitter.com/',
        //         'instagram' => 'https://www.instagram.com/',
        //         'youtube' => 'https://www.youtube.com/', 
        //         'linkedin' => 'https://www.linkedin.com/', 
        //         'about' => $list[$i]['about'],
        //         'quote' => $list[$i]['quote'],
        //         'interested' => 'Designing',
        //         'language' => 'English, French',
        //         'remember_token' => Str::random(10),
        //     ]);
    
        //     $date = date('Y-m-d H:i:s');
        //     $date2 = date('Y-m-d H:i:s',time() + 1);
        //     $date3 = date('Y-m-d H:i:s',time() + 2);
        //     // $postId = [1,2];
        //       // id = 1+3+3
        //     Post::create([
        //             'user_id' => $userId,
        //             'type' => 'create',
        //             'statu' => "Created account",
        //             'text' => $user->name." has created a new SocialChat account.",
        //             'time' => $date,
        //         ]);
        //         // id = 2+3+3
        //     Post::create([
        //             'user_id' => $userId,
        //             'type' => 'cover_default',
        //             'statu' => "Changed cover picture",
        //             'text' => "",
        //             'time' => $date2,
        //         ]);
        //         // id = 3+3+3
        //     Post::create([
        //             'user_id' => $userId,
        //             'type' => 'profile_default',
        //             'statu' => "Changed profile picture",
        //             'text' => "",
        //             'time' => $date3,
        //         ]);
        //     $BGpics = array("bg1.jpg","bg2.jpg","bg3.jpg","bg4.jpg","bg5.jpg","bg6.jpg","bg7.jpg","bg8.jpg","bg9.jpg");
        // $Bpic = array_rand($BGpics,1);
        // Image::create([
        //     'post_id' => $postId[0],
        //     'user_id' => $userId,
        //     'name' => 'BG/'.$BGpics[$Bpic],
        //     'type' => 'cover', 
        // ]); 
        // Image::create([
        //     'post_id' => $postId[0],
        //     'user_id' => $userId,
        //     'name' => 'BG/'.$BGpics[$Bpic],
        //     'type' => 'post', 
        // ]); 

        // if ($list[$i]['gender']== 'female') {
        //     $femalePics = array("female1.jpg","female2.jpg","female3.jpg","female4.jpg","female5.jpg","female6.jpg","female7.jpg","female8.jpg");
        //     $Fpic = array_rand($femalePics,1);
        //     Image::create([
        //         'post_id' => $postId[1],
        //         'user_id' => $userId,
        //         'name' => 'FemalePic/'.$femalePics[$Fpic],
        //         'type' => 'profile',
        //     ]);
        //     Image::create([
        //         'post_id' => $postId[1],
        //         'user_id' => $userId,
        //         'name' => 'FemalePic/'.$femalePics[$Fpic],
        //         'type' => 'post',
        //     ]);
        // }
        // if ($list[$i]['gender'] == 'male') {
        //     $malePics = array("male1.jpg","male2.jpg","male3.jpg","male4.jpg","male5.jpg","male6.jpg","male7.jpg","male8.jpg");
        //     $Mpic = array_rand($malePics,1);
        //     Image::create([
        //         'post_id' => $postId[1], 
        //         'user_id' => $userId,
        //         'name' => 'MalePic/'.$malePics[$Mpic],
        //         'type' => 'profile',
        //     ]);
        //     Image::create([
        //         'post_id' => $postId[1],
        //         'user_id' => $userId,
        //         'name' => 'MalePic/'.$malePics[$Mpic],
        //         'type' => 'post',
        //     ]);
        // }
        //     $postId1 = $postId1+3;
        //     $postId2 = $postId2+3;
        // }

        // // add relations 
      
        // for ($i=1; $i < 2; $i++) { 
        //     for ($j=1; $j < 5; $j++) { 
        //         if($i != $j){
        //             Friend::create([
        //                 'user_id' => $j,
        //                 'friend_id' => $i,
        //             ]);
        //             FriendRequest::create([
        //                 'user_from' => $i,
        //                 'user_to' => $j,
        //                 'status' => 'accepted',
        //             ]);
        //         }
        //     }
        // }

      //create deroctory

      // for ($i=1; $i < 10; $i++) { 
      //   File::makeDirectory(public_path('images/posts/'.$i));
      //   File::makeDirectory(public_path('videos/posts/'.$i));
      // }
      

      //create post

      // $postId2 = 61;

      // $postId2 = 31;

      $postId2 = 13;

      
      $feelings = array("Happy","Sad","Loved","Angry","Crazy","Hungry","Sleepy","Bored");

      $text = array("In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
      "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
      "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
      "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.");

      $imagesPost = array("01.jpg","02.jpg","03.jpg","04.jpg");

      for ($i=1; $i < 5; $i++) {
        for ($j=0; $j < 4; $j++) {
          Post::create([
            'user_id' => $i,
            'type' => 'post',
            'statu' => 'is feeling '.$feelings[array_rand($feelings)],
            'text' => $text[array_rand($text)],
            'time' => date("Y-m-d H:i:s",time() + 5),
          ]);
        }
        
        $postId2++;

        Video::create([
          'post_id' => $postId2,
          'user_id' => $i,
          'name' => 'videoPost.mp4',
        ]);

        $postId2++;
        Image::create([
          'post_id' => $postId2,
          'user_id' => $i,
          'name' => $imagesPost[0],
          'type' => 'post', 
        ]);

        $postId2++;

        for ($j=0; $j < 3; $j++) {
          Image::create([
            'post_id' => $postId2,
            'user_id' => $i,
            'name' => $imagesPost[$j+1],
            'type' => 'post', 
          ]);
        }

        
        $postId2++;
      }

    }
}
