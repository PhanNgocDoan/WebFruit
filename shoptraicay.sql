-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 09, 2024 lúc 05:05 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoptraicay6`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `album`
--

CREATE TABLE `album` (
  `MaAlbum` int(11) NOT NULL,
  `HinhAnh` varchar(255) NOT NULL,
  `LinkVideo` varchar(255) DEFAULT NULL,
  `TieuDe` varchar(255) DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL,
  `Loai` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `album`
--

INSERT INTO `album` (`MaAlbum`, `HinhAnh`, `LinkVideo`, `TieuDe`, `Link`, `Loai`) VALUES
(1, 'album3.jpg', 'v', 'Hình ảnh slider 1', 'v', 'slider'),
(2, 'chat.png', NULL, NULL, NULL, 'socal'),
(3, 'album2.jpg', NULL, 'Hình ảnh slider 2', NULL, 'slider'),
(4, 'album1.jpg', 'v', 'Hình ảnh slider 3', 'v', 'slider'),
(6, 'logo2.jpg', NULL, NULL, NULL, 'logo'),
(7, 'banner-qc.jpg', NULL, NULL, NULL, 'banner'),
(8, 'chat.png', NULL, NULL, NULL, 'falcon'),
(11, 'cherry1.jpg', NULL, NULL, NULL, 'ass');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baiviet`
--

CREATE TABLE `baiviet` (
  `MaBaiViet` int(11) NOT NULL,
  `TieuDe` varchar(255) NOT NULL,
  `Anh` varchar(255) NOT NULL,
  `MoTa` varchar(255) DEFAULT NULL,
  `NoiDung` mediumtext DEFAULT NULL,
  `NgayDang` date DEFAULT NULL,
  `Loai` varchar(20) NOT NULL,
  `TinhTrang` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `baiviet`
--

INSERT INTO `baiviet` (`MaBaiViet`, `TieuDe`, `Anh`, `MoTa`, `NoiDung`, `NgayDang`, `Loai`, `TinhTrang`) VALUES
(1, 'Có nên uống nước trái cây mỗi ngày?', 'anh-chup-man-hinh-2023-12-15-l-8728-4031-1702621925.png', 'Tôi thích nước ép trái cây nên thường uống mỗi ngày. Thói quen này có tốt không? (Thanh Hoa, 31 tuổi, Hà Nội)', '<h2><strong>Có nên uống nước trái cây mỗi ngày?</strong></h2><p>Tôi thích nước ép trái cây nên thường uống mỗi ngày. Thói quen này có tốt không? (Thanh Hoa, 31 tuổi, Hà Nội)</p><p><strong>Trả lời:</strong></p><p>Nước trái cây chứa vitamin, khoáng chất, bổ sung nước nên thức uống này có thể cải thiện sức khỏe, tăng khả năng phòng bệnh. Chẳng hạn nước ép cam, táo cung cấp vitamin C, giúp hấp thụ sắt, giảm viêm và tăng cường khả năng miễn dịch. Một số loại khác còn bổ sung canxi và sắt, tăng cường lưu lượng máu, mật độ khoáng của xương.</p><p>Tuy nhiên, uống nước trái cây nhiều đường, calo, ít chất xơ hàng ngày và không điều chỉnh chế độ dinh dưỡng có thể bất lợi cho sức khỏe.</p><p><i>Tăng đường máu: </i>Nước trái cây có thể không phù hợp cho bệnh nhân tiểu đường vì thiếu chất xơ và chứa nhiều fructose (một loại đường tự nhiên) có nguy cơ làm tăng lượng đường trong máu.</p><p>Thực phẩm có chỉ số đường huyết (GI) dựa trên mức độ làm tăng lượng đường trong máu chậm hay nhanh. Người tiền tiểu đường hoặc tiểu đường muốn uống nước ép cần dùng loại có chỉ số thấp, không quá 55. Chẳng hạn nước ép táo có chỉ số đường huyết là 41, nước cam khoảng 50. Không dùng nước ngọt có đường vì GI 63.</p><p><i>Thiếu chất xơ: </i>Uống nước ép <a href=\"https://vnexpress.net/dieu-gi-xay-ra-khi-ban-it-an-rau-qua-4686793.html\">trái cây</a> thay vì ăn nguyên quả có thể bỏ lượng chất xơ, dưỡng chất thường có trong vỏ, hạt xơ. Trong khi chất xơ thúc đẩy sức khỏe đường ruột, duy trì cân nặng khỏe mạnh. Loại chất xơ hòa tan còn có công dụng giảm mức cholesterol và kiểm soát lượng đường trong máu.</p><p>Theo Bộ Nông nghiệp Mỹ (USDA), trong khi một cốc nước cam chỉ chứa 0,5 g chất xơ, một quả cam lớn có tới 4,4 g. Tương tự, chất xơ có trong một cốc nước ép táo là 0,5 g, một quả táo lớn chứa 5,4 g. Lượng khuyến nghị trong chế độ ăn uống 25-30 g chất xơ mỗi ngày ở người trưởng thành.</p><p><picture><source srcset=\"https://i1-suckhoe.vnecdn.net/2023/12/15/Anh-chup-Man-hinh-2023-12-15-l-4704-9109-1702621925.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=PN8aUfQCB-Yo2ebwBwYyuQ 1x, https://i1-suckhoe.vnecdn.net/2023/12/15/Anh-chup-Man-hinh-2023-12-15-l-4704-9109-1702621925.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=NWkRoGFi5Xup8mdI3NMszA 1.5x, https://i1-suckhoe.vnecdn.net/2023/12/15/Anh-chup-Man-hinh-2023-12-15-l-4704-9109-1702621925.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=puIt192LPFtbX5YsZto45w 2x\"><img src=\"https://i1-suckhoe.vnecdn.net/2023/12/15/Anh-chup-Man-hinh-2023-12-15-l-4704-9109-1702621925.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=PN8aUfQCB-Yo2ebwBwYyuQ\" alt=\"Uống nước ép trái cây thay vì ăn nguyên quả có thể bỏ lượng chất xơ, dưỡng chất thường có trong vỏ, hạt. Ảnh: Freepik\" width=\"680\" height=\"452\"></picture></p><p>Uống nước ép trái cây thay vì ăn nguyên quả có thể bỏ lượng chất xơ, dưỡng chất thường có trong vỏ, hạt. Ảnh: <i>Freepik</i></p><p><i>Tăng cân: </i>Nước ép trái cây có thể chứa nhiều calo, dẫn đến tăng cân nếu dùng quá nhiều trong thời gian dài, thường là một ly lớn hơn 230 ml mỗi ngày. Một số người còn có thói quen cho thêm đường vào để dễ uống nên không tốt khi muốn giảm cân và kiểm soát đường huyết.</p><p><i>Ảnh hưởng tới răng:</i> Uống quá nhiều nước ép trái cây, nhất là <a href=\"https://vnexpress.net/5-thuc-uong-lanh-manh-cho-nguoi-giam-can-4683662.html\">đồ uống</a> có tính axit như táo, nước cam có thể làm mòn răng. Theo Hiệp hội Nha khoa Mỹ (ADA), mòn răng có thể dẫn đến đau hoặc nhạy cảm khi uống đồ nóng, lạnh hoặc ngọt; răng chuyển màu vàng, nguy cơ sâu cao hơn...</p><p>Uống nước trái cây mỗi ngày không hẳn là thói quen không tốt nhưng mức độ ảnh hưởng có thể khác nhau tùy thuộc vào tình trạng sức khỏe, thành phần và loại nước ép. Nước trái cây nguyên chất, không thêm đường là lựa chọn lành mạnh hơn nhưng bạn chỉ nên tiêu thụ tối đa 230 ml mỗi ngày.</p><p>Với loại đóng chai, bạn nên kiểm tra thành phần trước khi mua để tránh có nhiều đường bổ sung và thừa calo. Người bệnh tiểu đường, đang muốn giảm cân, răng nhạy cảm không nên uống nước ép thường xuyên và ăn trái cây nguyên quả để nhận được các chất dinh dưỡng khác.</p>', '2024-01-06', 'tintuc', 1),
(2, '7 loại trái cây phòng ung thư vú', '393067243-741574237860022-4434917599486112969-n-1702650708.png', 'Lựu, táo, nho chứa các chất chống oxy hóa, nhiều dưỡng chất có thể phòng ngừa ung thư vú bằng cách ngăn khối u ác tính ở ngực hình thành.', '<p><img src=\"https://i1-suckhoe.vnecdn.net/2023/12/15/403403480-1810609902771081-5498169529174981232-n-1702651267.png?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=iFbnAijI3f7-R7nFufUVvw\" alt=\"\" width=\"1200\" height=\"754\"></p><p>&nbsp;</p><p><i>Trái cây</i> <i>họ cam quýt </i>như cam, chanh, bưởi có thể ức chế tăng sinh tế bào. Polysaccharide từ vỏ cam quýt ức chế hình thành mạch dẫn đến giảm hình thành và ngăn chặn sự di chuyển của các tế bào khối u vú ác tính.</p><p>Flavonoid là chất chuyển hóa trung gian của thực vật như hesperidin, naringin có tác dụng ức chế tăng sinh và thúc đẩy quá trình chết tế bào khối u.</p><ul><li><a href=\"https://vnexpress.net/nang-nguc-co-thanh-ung-thu-vu-4689139.html\">Nang ngực có thành ung thư vú?</a></li><li><a href=\"https://vnexpress.net/9-mon-an-uong-giam-nguy-co-tai-phai-ung-thu-vu-4682993.html\">9 món ăn uống giảm nguy cơ tái phái ung thư vú</a></li><li><a href=\"https://vnexpress.net/5-nhom-thuc-pham-nguoi-ung-thu-vu-nen-an-4676727.html\">5 nhóm thực phẩm người ung thư vú nên ăn</a></li></ul>', '2023-12-22', 'tintuc', 1),
(3, '7 trái cây giàu vitamin C phòng ung thư', '403406202-165835266616550-8403230387648276086-n-1702022569.png', 'Ổi, dâu tây, đu đủ, cam đều chứa lượng lớn vitamin C có tác dụng chống viêm, hỗ trợ bảo vệ tế bào trước gốc tự do, phòng ung thư.', '<h2><strong>7 trái cây giàu vitamin C phòng ung thư</strong></h2><p>Ổi, dâu tây, đu đủ, cam đều chứa lượng lớn vitamin C có tác dụng chống viêm, hỗ trợ bảo vệ tế bào trước gốc tự do, phòng ung thư.</p><p>&nbsp;</p><p><picture><source srcset=\"https://i1-suckhoe.vnecdn.net/2023/12/08/403406191-886864166361169-7013930383343526570-n-1702022050.png?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=FF2bWMC3l8cKXTCfp_7lrA 1x, https://i1-suckhoe.vnecdn.net/2023/12/08/403406191-886864166361169-7013930383343526570-n-1702022050.png?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=5EF5j4xkqiWyJSKgPB7uXQ 2x\"><img src=\"https://i1-suckhoe.vnecdn.net/2023/12/08/403406191-886864166361169-7013930383343526570-n-1702022050.png?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=FF2bWMC3l8cKXTCfp_7lrA\" alt=\"\" width=\"1200\" height=\"799\"></picture></p><p>Theo Viện Ung thư Quốc gia Mỹ, ăn nhiều trái cây và rau quả chứa nhiều vitamin C có liên quan đến giảm nguy cơ ung thư. Dưỡng chất này hoạt động giống như chất chống oxy hóa, có tác dụng chống viêm và bảo vệ tế bào khỏi hư hại do các gốc tự do gây ra.</p><p>Nghiên cứu công bố năm 2018 của Trường Y Harvard (Mỹ), trên 182.000 phụ nữ (từ 24 tuổi trở lên), cho thấy người ăn hơn 5 khẩu phần trái cây và rau củ giàu vitamin C mỗi ngày giảm 11% nguy cơ ung thư vú.</p><p>Dưới đây là 7 loại quả giàu vitamin C, theo Bộ Nông nghiệp Mỹ.</p><p><i>Ổi </i>là một trong những loại trái cây giàu vitamin C nhất. 100 g ổi ruột hồng cung cấp tới 125 mg vitamin C.</p><p><picture><source srcset=\"https://i1-suckhoe.vnecdn.net/2023/12/08/fresh-strawberries-wooden-table-1702022132.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=5FDYgPP5Wh-MEXopxgLzGw 1x, https://i1-suckhoe.vnecdn.net/2023/12/08/fresh-strawberries-wooden-table-1702022132.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=74wu6pzRCvUf7mW7xwhX1Q 2x\"><img src=\"https://i1-suckhoe.vnecdn.net/2023/12/08/fresh-strawberries-wooden-table-1702022132.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=5FDYgPP5Wh-MEXopxgLzGw\" alt=\"\" width=\"1200\" height=\"800\"></picture></p><p><i>Dâu tây</i> thuộc loại quả mọng giàu chất chống oxy hóa có tác dụng chống viêm và căng thẳng oxy hóa - sự mất cân bằng giữa các gốc tự do và chất chống oxy hóa trong cơ thể, gây hại tế bào dẫn đến bệnh. Một cốc dâu tây cắt lát (100 g) có hơn 97 mg vitamin C.</p><p><picture><source srcset=\"https://i1-suckhoe.vnecdn.net/2023/12/08/fresh-papaya-cut-into-pieces-put-black-plate-1702022231.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=nmvaL0ldY38e4DtqAK3yZg 1x, https://i1-suckhoe.vnecdn.net/2023/12/08/fresh-papaya-cut-into-pieces-put-black-plate-1702022231.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=SSEaBkMkGdzGmv4y1cEwuQ 2x\"><img src=\"https://i1-suckhoe.vnecdn.net/2023/12/08/fresh-papaya-cut-into-pieces-put-black-plate-1702022231.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=nmvaL0ldY38e4DtqAK3yZg\" alt=\"\" width=\"1200\" height=\"800\"></picture></p><p><i>Đu đủ</i> là trái cây nhiệt đới, được nhiều người ưa chuộng. Một cốc (100 g) <a href=\"https://vnexpress.net/an-du-du-co-tang-kich-thuoc-vong-mot-4677548.html\">đu đủ</a> cắt nhỏ chứa khoảng 88 mg vitamin C. Trái cây này còn chứa chất chống oxy hóa là lycopene, giúp trung hòa các gốc tự do, giảm nguy cơ ung thư và có lợi cho người đang điều trị bệnh này.</p><p><picture><source srcset=\"https://i1-suckhoe.vnecdn.net/2023/12/08/wooden-board-full-juicy-slices-orange-fruit-stone-table-1702022310.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=n0Bxfb7DwfqU7j586mLF_A 1x, https://i1-suckhoe.vnecdn.net/2023/12/08/wooden-board-full-juicy-slices-orange-fruit-stone-table-1702022310.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=hNWbelm85dAIhKSvX6kEcg 2x\"><img src=\"https://i1-suckhoe.vnecdn.net/2023/12/08/wooden-board-full-juicy-slices-orange-fruit-stone-table-1702022310.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=n0Bxfb7DwfqU7j586mLF_A\" alt=\"\" width=\"1200\" height=\"794\"></picture></p><p><i>Cam</i> có lượng vitamin C dồi dào, 100 g cung cấp gần 83 mg dưỡng chất này. Trái cây họ cam quýt khác và nước ép của chúng rất giàu vitamin C, chất chống oxy hóa. Ăn cam thường xuyên cách tốt để <a href=\"https://vnexpress.net/an-dau-xanh-phong-ung-thu-4684927.html\">phòng ngừa ung thư</a>.</p><p><picture><source srcset=\"https://i1-suckhoe.vnecdn.net/2023/12/08/403406202-165835266616550-8403230387648276086-n-1702022569.png?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=nuDg-N2b0LqmXfr-i9CCJA 1x, https://i1-suckhoe.vnecdn.net/2023/12/08/403406202-165835266616550-8403230387648276086-n-1702022569.png?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=zEsfd8QIAjY2N0vJZsXgEw 2x\"><img src=\"https://i1-suckhoe.vnecdn.net/2023/12/08/403406202-165835266616550-8403230387648276086-n-1702022569.png?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=nuDg-N2b0LqmXfr-i9CCJA\" alt=\"\" width=\"1200\" height=\"799\"></picture></p><p><i>Kiwi</i> cũng giàu chất chống oxy hóa có tác dụng mạnh, giảm viêm, có lợi trong phòng ngừa bệnh. Một quả kiwi (100 g) chứa 64 mg vitamin C, hơn 1 g protein, 0,52 g chất béo, 3 g chất xơ, 9 g đường và hơn 14 g carbohydrate.</p><p><picture><source srcset=\"https://i1-suckhoe.vnecdn.net/2023/12/08/403396342-390764046615805-2995541092800542393-n-1702022621.png?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=BIeEhy5CBPT4NSNl1LsoXQ 1x, https://i1-suckhoe.vnecdn.net/2023/12/08/403396342-390764046615805-2995541092800542393-n-1702022621.png?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=jJTKrfo5OZhafEhQAzzpGQ 2x\"><img src=\"https://i1-suckhoe.vnecdn.net/2023/12/08/403396342-390764046615805-2995541092800542393-n-1702022621.png?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=BIeEhy5CBPT4NSNl1LsoXQ\" alt=\"\" width=\"1200\" height=\"799\"></picture></p><p><i>Chanh</i> được dùng phổ biến trong chế biến món ăn, thức uống. 100 g chanh chứa hơn 34 mg vitamin C, một quả nhỏ hơn có khoảng 19 mg. Ăn cả quả hoặc dùng nước ép để tận dụng nguồn dưỡng chất này của chanh.</p><p><picture><source srcset=\"https://i1-suckhoe.vnecdn.net/2023/12/08/403402157-1032699621282228-5030314533628059799-n-1702022663.png?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=6c_vp2Yky3jXyK-pNo4cnQ 1x, https://i1-suckhoe.vnecdn.net/2023/12/08/403402157-1032699621282228-5030314533628059799-n-1702022663.png?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=CCbQOl5uJ8DMoLePVQF0ig 2x\"><img src=\"https://i1-suckhoe.vnecdn.net/2023/12/08/403402157-1032699621282228-5030314533628059799-n-1702022663.png?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=6c_vp2Yky3jXyK-pNo4cnQ\" alt=\"\" width=\"1200\" height=\"799\"></picture></p><p><i>Quả mâm xôi </i>chứa lượng lớn vitamin C (30 mg trong 100g quả tươi), là chất chống oxy hóa mạnh có thể ngăn ngừa và làm chậm quá trình oxy hóa. Mâm xôi cung cấp nhiều chất xơ, ellagitannin, anthocyanin, axit phenolic... có tác dụng chống viêm, giảm <a href=\"https://vnexpress.net/9-mon-an-uong-giam-nguy-co-tai-phai-ung-thu-vu-4682993.html\">nguy cơ ung thư</a>.</p><p>Theo Ủy ban Thực phẩm và Dinh dưỡng Mỹ, cơ thể cần tối thiểu 10 mg vitamin C mỗi ngày, mức khuyến nghị hàng ngày thay đổi theo độ tuổi, giới tính và lối sống như hút thuốc. Nam giới từ 19 tuổi trở lên cần 90 mg và 75 mg với nữ.</p><p>Người thường hút thuốc cần bổ sung vitamin C và tăng thêm 35 mg mỗi ngày. Phụ nữ mang thai là 85 mg và phụ nữ cho con bú nên tiêu thụ 120 mg vitamin C mỗi ngày.</p>', '2023-12-22', 'tintuc', 1),
(4, 'Trẻ dưới một tuổi nên uống nước ép hay ăn trái thô?', 'close-up-photo-fresh-citrus-fr-8021-5281-1701674220.jpg', 'Con tôi dưới một tuổi, đang ăn dặm, nên tập cho bé ăn trái cây thô hay uống nước ép? (Hồng Anh, TP HCM)', '<h2><strong>Trẻ dưới một tuổi nên uống nước ép hay ăn trái thô?</strong></h2><p>Con tôi dưới một tuổi, đang ăn dặm, nên tập cho bé ăn trái cây thô hay uống nước ép? (Hồng Anh, TP HCM)</p><p><strong>Trả lời:</strong></p><p>Trẻ mới bắt đầu ăn dặm nên ăn trái cây thô hay uống nước ép tùy thuộc vào nhiều yếu tố và cần một số lưu ý nhất định.</p><p>Ví dụ, với trái cây mềm (bơ, chuối, nho, kiwi...), bạn có thể cắt hình hạt lựu hay miếng nhỏ để cho bé làm quen. Với trái cây cứng hơn (táo, ổi, mận...), bạn nghiền nhuyễn, xay hoặc hấp cách thủy rồi tán ra cho con ăn.</p><p>Khi bé bắt đầu tập ăn <a href=\"https://vnexpress.net/cach-an-trai-cay-mang-lai-nhieu-loi-ich-cho-suc-khoe-4549100.html\">trái cây</a>, bạn nên cho ăn lượng nhỏ, vừa đủ để hệ tiêu hóa hấp thụ, kiểm tra bé có bị dị ứng hay không.</p><p>Nước ép trái cây mang lại một số lợi ích cho sức khỏe. Bạn có thể cho con uống trong một số trường hợp, ví dụ bé không ăn được hoặc loại trái cây đó cứng. Tuy vậy, loại nước ép này chưa hoàn toàn phù hợp với trẻ dưới một tuổi, có thể không chứa nhiều dinh dưỡng. Thành phần <a href=\"https://nutrihome.vn/chat-xo/\">chất xơ</a>, vitamin và khoáng chất trong nước ép trái cây không nhiều, chủ yếu trong phần bã bỏ đi. Bé nên ăn trái cây thô vì tốt hơn.</p><p>Bạn không nên thêm đường vào nước ép trái cây cho bé. Không cho con dùng nước ép trái cây khi đang tiêu chảy hoặc mất nước.</p><p>Trẻ ở độ tuổi mới ăn dặm còn khá nhạy cảm, phụ huynh nên đưa con đi khám dinh dưỡng để được bác sĩ tư vấn, hướng dẫn cách chọn, chế biến thực đơn phù hợp.</p>', '2023-12-22', 'tintuc', 1),
(5, 'dá', 'dautay3.jpg', 'mota', '<p>a</p>', '2023-12-22', 'tieuchi', 1),
(6, 'Giới thiệu', 'duahau2.jpg', 'mota11', '<p><strong>Trái cây nhập khẩu TPHCM |&nbsp;Han Fruit</strong></p><p>&nbsp; &nbsp; ♦&nbsp;&nbsp; Với thực trạng&nbsp;trái cây bẩn đang tràn lan trên thị trường (Cam Trung Quốc không hạt, chuối phun thuốc để cả tháng không hư, v..v), chúng tôi thành lập để mang trên mình sứ mệnh \"Vì sức khỏe người tiêu dùng Việt\".</p><p>&nbsp; &nbsp;&nbsp;<img src=\"https://hanfruit.vn/upload/images/cam-trung-quoc-1.jpg\" alt=\"cam-trung-quoc\" width=\"480\" height=\"360\"></p><p><i>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Khó để phân biệt Cam Trung Quốc và Cam Mỹ trên thị trường hiện nay.</i></p><p>&nbsp; &nbsp; &nbsp; ♦&nbsp;<strong>Trái cây nhập khẩu</strong>&nbsp;có lẽ còn mới mẻ với phần lớn người tiêu dùng Việt nhưng những gia đình khá giả từ lâu họ đã chọn chúng như là một món ăn hàng ngày không thể thiếu. Bởi lẽ với sự đảm bảo tiêu chuẩn gắt gao về an toàn vệ sinh thực phẩm, ai cũng muốn mang điều đó về cho gia đình của mình.</p><p>&nbsp; &nbsp; ♦ &nbsp;Han Fruit tự tin về giá cả tốt nhất thị trường nên quý khách ai cũng có thể sở hữu được sự tươi ngon từ&nbsp;<a href=\"http://hanfruit.com/tao-rockit-new-zealand-ong-4-trai-63.html\">Táo Rockit New Zealand</a>,<a href=\"http://hanfruit.com/nho-den-khong-hat-my-3.html\">&nbsp;nho đen không hạt Mỹ</a>,&nbsp;<a href=\"http://hanfruit.com/man-xanh-my-22.html\">mận xanh Mỹ</a>, v..v.<i><strong>&nbsp;Trái cây sạch</strong></i>&nbsp;cung cấp cho ta nhiều vitamin và dưỡng chất tốt cho cơ thể, 1 làn da căn mịn và luôn tươi trẻ.&nbsp; <img src=\"https://hanfruit.vn/upload/images/13271985_10205799835306124_1172950157_o.jpg\" alt=\"trai-cay-nhap-khau-tphcm\" width=\"480\" height=\"343\"> &nbsp;&nbsp;<img src=\"https://hanfruit.vn/upload/images/13228063_10205799835266123_911065016_n.jpg\" alt=\"trai-cay-nhap-khau-tphcm\" width=\"480\" height=\"343\"></p><p><i>&nbsp;Cam Navel Mỹ của Han Fruit. (hình chụp tại kho)</i></p><p>&nbsp;</p><p><img src=\"https://hanfruit.vn/upload/images/13271888_10205799835946140_2060250272_o.jpg\" alt=\"trai-cay-nhap-khau-tphcm\" width=\"480\" height=\"343\"></p><p><i>Nho đen không hạt Úc (hình chụp tại kho) &nbsp;&nbsp;</i></p><p>&nbsp; <img src=\"https://hanfruit.vn/upload/images/13274960_10205799835866138_1197921827_o.jpg\" alt=\"trai-cay-nhap-khau\" width=\"480\" height=\"320\"></p><p><i>Táo Rockit New Zealand. (hình chụp tại kho)</i></p><p>&nbsp;</p><p><strong>Sức khỏe của bạn là lợi nhuận của chúng tôi -&nbsp;Han Fruit&nbsp;|&nbsp;</strong><a href=\"http://www.hanfruit.com/\"><strong>Trái cây nhập khẩu TPHCM.</strong></a></p><p>&nbsp;</p><p><strong>Đặc biệt:</strong>&nbsp;Han Fruit sẽ giao hàng hằng ngày nếu quý khách hàng có nhu cầu. Xin vui lòng liên hệ:</p><p><img src=\"https://hanfruit.vn/upload/images/DT.png\" alt=\"trai-cay-nhap-khau-tphcm\" width=\"16\" height=\"17\"> &nbsp;0919 323 668&nbsp;- 0866 83 38 83</p><p><img src=\"https://hanfruit.vn/upload/images/FB.png\" alt=\"trai-cay-nhap-khau-tphcm\" width=\"16\" height=\"18\"> &nbsp;facebook.com/traicaynhapkhausaigon</p><p><img src=\"https://hanfruit.vn/upload/images/Mail.png\" alt=\"trai-cay-nhap-khau-tphcm\" width=\"20\" height=\"16\"> dangthanhhp.84@gmail.com</p><p><img src=\"https://hanfruit.vn/upload/images/Web.png\" alt=\"trai-cay-nhap-khau-tphcm\" width=\"20\" height=\"18\"> www.hanfruit.com</p><p><img src=\"https://hanfruit.vn/upload/images/%C4%90C.png\" alt=\"\" width=\"18\" height=\"16\"> Kho: 69 Nguyễn Trọng Lội - Phường 4 - Quận Tân Bình.&nbsp;</p><p>&nbsp;</p>', '2024-01-06', 'gioithieu', 1),
(7, 't', 'cam1.jpg', 't', '<p>D/c: Trường Cao đẳng Kỹ thuật Cao Thắng 65 Đ. Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh 700000</p><p>Phone number: 0123456788</p><p><a href=\"mailto:tdshop@gmail.com\">Email: tdshop@gmail.com</a></p>', '2024-01-06', 'lienhe', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banggia`
--

CREATE TABLE `banggia` (
  `IDGia` int(11) NOT NULL,
  `MaSanPham` int(11) NOT NULL,
  `ChietKhau` int(11) NOT NULL DEFAULT 0,
  `GiaBan` int(11) NOT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banggia`
--

INSERT INTO `banggia` (`IDGia`, `MaSanPham`, `ChietKhau`, `GiaBan`, `NgayBatDau`, `NgayKetThuc`) VALUES
(1, 1, 0, 190, '2024-01-05', '2024-01-20'),
(2, 5, 50, 60, '2024-01-06', '2024-01-16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chatbox`
--

CREATE TABLE `chatbox` (
  `chatID` int(11) NOT NULL,
  `MaTK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chatbox`
--

INSERT INTO `chatbox` (`chatID`, `MaTK`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_hoadon`
--

CREATE TABLE `ct_hoadon` (
  `MaHD` int(11) NOT NULL,
  `MaTraiCay` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` int(11) NOT NULL,
  `TongGia` int(11) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `Email` char(55) NOT NULL,
  `Note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_hoadon`
--

INSERT INTO `ct_hoadon` (`MaHD`, `MaTraiCay`, `SoLuong`, `DonGia`, `TongGia`, `HoTen`, `Email`, `Note`) VALUES
(1, 5, 2, 60, 120, 'day la  tuan', 'tuanww012@gmail.com', 'ok'),
(1, 3, 2, 180, 360, 'day la  tuan', 'tuanww012@gmail.com', 'ok');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvi`
--

CREATE TABLE `donvi` (
  `MaDonVi` int(11) NOT NULL,
  `TenDonVi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donvi`
--

INSERT INTO `donvi` (`MaDonVi`, `TenDonVi`) VALUES
(1, 'Kg'),
(2, 'Gram'),
(3, 'Trái'),
(4, 'Hộp'),
(5, 'Giỏ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallery`
--

CREATE TABLE `gallery` (
  `MaGallery` int(11) NOT NULL,
  `MaTCay` int(11) DEFAULT NULL,
  `Anh` varchar(255) NOT NULL,
  `Loai` varchar(20) NOT NULL,
  `MaGQ` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `gallery`
--

INSERT INTO `gallery` (`MaGallery`, `MaTCay`, `Anh`, `Loai`, `MaGQ`) VALUES
(1, 1, 'cam1.jpg', 'san-pham', NULL),
(2, 1, 'cam2.jpg', 'san-pham', NULL),
(3, 1, 'cam3.jpg', 'san-pham', NULL),
(4, NULL, '4-01.jpg', 'gio-qua', 1),
(5, NULL, '4-08.jpg', 'gio-qua', 1),
(6, NULL, '5-13-1.jpg', 'gio-qua', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaGioHang` int(11) NOT NULL,
  `MaTaiKhoan` int(11) NOT NULL,
  `MaSanPham` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`MaGioHang`, `MaTaiKhoan`, `MaSanPham`, `SoLuong`) VALUES
(1, 2, 2, 10),
(2, 2, 5, 3),
(3, 2, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gioqua`
--

CREATE TABLE `gioqua` (
  `MaGioQua` int(11) NOT NULL,
  `TenGioQua` varchar(255) NOT NULL,
  `MoTaGQ` varchar(255) DEFAULT NULL,
  `NgayTao` date NOT NULL,
  `GiaBan` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `TinhTrang` smallint(6) NOT NULL,
  `Anh` varchar(255) NOT NULL,
  `MaLoaiGQ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gioqua`
--

INSERT INTO `gioqua` (`MaGioQua`, `TenGioQua`, `MoTaGQ`, `NgayTao`, `GiaBan`, `SoLuong`, `TinhTrang`, `Anh`, `MaLoaiGQ`) VALUES
(1, 'giỏ quà', 'aaa', '2024-01-06', 300, 11, 1, '7-01.jpg', 1),
(2, 'Giỏ quà tưng bừng', 'aaa', '2024-01-07', 123, 10, 1, '4-08.jpg', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gioqua_traicay`
--

CREATE TABLE `gioqua_traicay` (
  `gioqua_id` int(11) NOT NULL,
  `traiCay_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gioqua_traicay`
--

INSERT INTO `gioqua_traicay` (`gioqua_id`, `traiCay_id`, `created_at`, `updated_at`, `quantity`) VALUES
(2, 1, '2024-01-07', '2024-01-07', 10),
(2, 3, '2024-01-07', '2024-01-07', 10),
(1, 3, '2024-01-07', '2024-01-07', 4),
(1, 4, '2024-01-07', '2024-01-07', 2),
(1, 7, '2024-01-07', '2024-01-07', 4),
(1, 8, '2024-01-07', '2024-01-07', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_chat`
--

CREATE TABLE `history_chat` (
  `MaChat` int(11) NOT NULL,
  `NoiDung` varchar(255) NOT NULL,
  `ThoiGian` datetime NOT NULL,
  `IsUser` int(11) NOT NULL,
  `Seen` char(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `history_chat`
--

INSERT INTO `history_chat` (`MaChat`, `NoiDung`, `ThoiGian`, `IsUser`, `Seen`) VALUES
(1, 'hi shop', '2023-12-20 07:40:05', 1, 'true'),
(1, 'chao ban', '2023-12-20 07:40:25', 0, 'true'),
(1, 'ban can ho tro gi?', '2023-12-20 07:41:00', 0, 'true'),
(1, '...', '2023-12-20 07:41:18', 0, 'true'),
(1, 'lol', '2023-12-20 07:41:23', 1, 'true'),
(1, 'kkkk', '2024-01-06 11:51:54', 1, 'true');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHD` int(11) NOT NULL,
  `MaTaiKhoan` int(11) NOT NULL,
  `NgayLapHD` date NOT NULL,
  `DiaChiGiaoHang` varchar(30) NOT NULL,
  `Phone` char(11) NOT NULL,
  `TinhTrang` varchar(20) NOT NULL,
  `DanhGia` varchar(10) NOT NULL,
  `ThanhTien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`MaHD`, `MaTaiKhoan`, `NgayLapHD`, `DiaChiGiaoHang`, `Phone`, `TinhTrang`, `DanhGia`, `ThanhTien`) VALUES
(1, 1, '2024-01-08', 'ho van long, quan binh tan', '0123456789', 'Hoàn thành', 'true', 480);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaigioqua`
--

CREATE TABLE `loaigioqua` (
  `MaLoai` int(20) NOT NULL,
  `TenLoai` varchar(255) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaigioqua`
--

INSERT INTO `loaigioqua` (`MaLoai`, `TenLoai`, `MoTa`) VALUES
(1, 'Giỏ quà sinh nhật', 'aaa'),
(2, 'Giỏ quà viếng thăm', 'aaa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaitraicay`
--

CREATE TABLE `loaitraicay` (
  `MaLoai` int(11) NOT NULL,
  `TenLoai` varchar(255) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaitraicay`
--

INSERT INTO `loaitraicay` (`MaLoai`, `TenLoai`, `MoTa`) VALUES
(1, 'Trái cây mùa hè', 'aaaa'),
(2, 'Trái cây mùa đông', 'aaaa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lo_nhap`
--

CREATE TABLE `lo_nhap` (
  `MaLo` int(11) NOT NULL,
  `TenLo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lo_nhap`
--

INSERT INTO `lo_nhap` (`MaLo`, `TenLo`) VALUES
(1, 'lohang1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNcc` int(11) NOT NULL,
  `TenNcc` varchar(20) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `Phone` varchar(10) DEFAULT NULL,
  `SoFax` varchar(10) NOT NULL,
  `DcMail` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`MaNcc`, `TenNcc`, `DiaChi`, `Phone`, `SoFax`, `DcMail`) VALUES
(1, 'Nông Sản Sao Khuê', 'quan1', '0123456789', '1111', 'saokhue@gmail.com'),
(2, 'Đông Dương Food', 'quan2', '0987654321', '2222', 'dongduong@gmail.com'),
(3, 'Nông Sản Nguyễn Vy', 'quan3', '0456893644', '3333', 'nguyenvy@gmail.com'),
(4, 'Nông Sản Dagrifood', 'quan4', '0123456784', '4444', 'dagrifood@gmail.com'),
(5, 'Nông Sản Vilaconic', 'quan5', '0123456783', '5555', 'vilaconic@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhaphang`
--

CREATE TABLE `nhaphang` (
  `MaNhapHang` int(255) NOT NULL,
  `MaLoNhap` int(11) NOT NULL,
  `MaTraiCay` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaNhap` int(11) NOT NULL,
  `MaNhaCungCap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhaphang`
--

INSERT INTO `nhaphang` (`MaNhapHang`, `MaLoNhap`, `MaTraiCay`, `SoLuong`, `GiaNhap`, `MaNhaCungCap`) VALUES
(1, 1, 1, 70, 200, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `MaTk` int(11) NOT NULL,
  `MaSp` int(11) DEFAULT NULL,
  `MaGQ` int(11) DEFAULT NULL,
  `Comment` mediumtext NOT NULL,
  `Rating` int(11) NOT NULL,
  `NgayThang` datetime NOT NULL,
  `TinhTrang` varchar(11) NOT NULL,
  `ReviewIMG` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTaiKhoan` int(11) NOT NULL,
  `TaiKhoan` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `Email` varchar(55) DEFAULT NULL,
  `Phone` varchar(11) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `HoTen` varchar(255) DEFAULT NULL,
  `IsAdmin` smallint(6) DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `TrangThai` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaTaiKhoan`, `TaiKhoan`, `MatKhau`, `Email`, `Phone`, `DiaChi`, `HoTen`, `IsAdmin`, `Avatar`, `TrangThai`) VALUES
(1, 'tuan123', '25f9e794323b453885f5181f1b624d0b', 'tuanww012@gmail.com', '0123456789', 'Ho Van Long ,Binh Tan,Tp HCM', 'Nguyen Minh Tuan', 0, '1354237.jpg', 0),
(2, 'tuan2', '9990775155c3518a0d7917f7780b24aa', '0306201093@caothang.edu.vn', '0123456789', 'huynh thuc khang, quan1', 'Nguyen Van A', 0, 'avatar.png', 0),
(3, 'admin', '202cb962ac59075b964b07152d234b70', '', '', '', '', 1, 'user-profile.png', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongke`
--

CREATE TABLE `thongke` (
  `MaThongKe` int(11) NOT NULL,
  `TongDoanhThu` int(11) NOT NULL,
  `Date` date NOT NULL,
  `ChiPhi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongke`
--

INSERT INTO `thongke` (`MaThongKe`, `TongDoanhThu`, `Date`, `ChiPhi`) VALUES
(1, 64, '2023-11-30', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `traicay`
--

CREATE TABLE `traicay` (
  `MaTraiCay` int(11) NOT NULL,
  `TenTraiCay` varchar(30) NOT NULL,
  `MoTa` varchar(255) DEFAULT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaGoc` int(11) NOT NULL,
  `MaNcc` int(11) NOT NULL,
  `MaLoai` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `Anh` varchar(255) NOT NULL,
  `TinhTrang` varchar(10) NOT NULL,
  `NoiDung` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `traicay`
--

INSERT INTO `traicay` (`MaTraiCay`, `TenTraiCay`, `MoTa`, `SoLuong`, `GiaGoc`, `MaNcc`, `MaLoai`, `UnitID`, `Anh`, `TinhTrang`, `NoiDung`) VALUES
(1, 'Cam', 'Được nhập từ Mỹ,...', 10, 144, 1, 1, 1, 'cam1.jpg', '1', NULL),
(2, 'Dâu Tây', 'Được trồng trên Đà Lạt xa xôi', 10, 200, 4, 2, 1, 'pic2.jpg', '1', NULL),
(3, 'Táo Mỹ', 'Giống táo mới được lai giống', 2, 180, 1, 1, 1, 'pic3.jpg', '1', NULL),
(4, 'Kiwi xanh', 'chua chua', 55, 80, 4, 2, 1, 'pic4.jpg', '1', NULL),
(5, 'Nho', '...', 0, 120, 4, 1, 1, 'pic5.jpg', '0', NULL),
(6, 'Bơ Việt Nam', 'Được nhập tại Việt Nam', 5, 120, 1, 1, 1, 'pic6.jpg', '1', NULL),
(7, 'Dưa hấu', 'aa', 50, 20, 1, 1, 3, 'pic7.jpg', '1', NULL),
(8, 'Chuối', 'Nhiều chất vitamin', 10, 25, 5, 1, 1, 'pic8.jpg', '1', NULL),
(9, 'Cherry', 'Ngon tuyệt', 15, 155, 5, 2, 1, 'pic9.jpg', '1', NULL),
(10, 'Xoài Cát', 'Ngọt thanh thanh', 20, 22, 1, 2, 1, 'pic10.jpg', '1', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`MaAlbum`);

--
-- Chỉ mục cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`MaBaiViet`);

--
-- Chỉ mục cho bảng `banggia`
--
ALTER TABLE `banggia`
  ADD PRIMARY KEY (`IDGia`),
  ADD KEY `FK_matc_bg2` (`MaSanPham`);

--
-- Chỉ mục cho bảng `chatbox`
--
ALTER TABLE `chatbox`
  ADD PRIMARY KEY (`chatID`),
  ADD KEY `FK_matkmessage` (`MaTK`);

--
-- Chỉ mục cho bảng `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  ADD KEY `FK_mahd2` (`MaHD`),
  ADD KEY `FK_matc` (`MaTraiCay`);

--
-- Chỉ mục cho bảng `donvi`
--
ALTER TABLE `donvi`
  ADD PRIMARY KEY (`MaDonVi`);

--
-- Chỉ mục cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`MaGallery`),
  ADD KEY `FK_matcay` (`MaTCay`),
  ADD KEY `FK_magq` (`MaGQ`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaGioHang`),
  ADD KEY `FK_masp_magiay` (`MaSanPham`),
  ADD KEY `FK_matk` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `gioqua`
--
ALTER TABLE `gioqua`
  ADD PRIMARY KEY (`MaGioQua`);

--
-- Chỉ mục cho bảng `history_chat`
--
ALTER TABLE `history_chat`
  ADD KEY `FK_machat` (`MaChat`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHD`),
  ADD KEY `FK_matk_x2` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `loaigioqua`
--
ALTER TABLE `loaigioqua`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `loaitraicay`
--
ALTER TABLE `loaitraicay`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `lo_nhap`
--
ALTER TABLE `lo_nhap`
  ADD PRIMARY KEY (`MaLo`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MaNcc`);

--
-- Chỉ mục cho bảng `nhaphang`
--
ALTER TABLE `nhaphang`
  ADD PRIMARY KEY (`MaNhapHang`),
  ADD KEY `khoangoai` (`MaLoNhap`),
  ADD KEY `khoangoai2` (`MaTraiCay`),
  ADD KEY `khoangoai3` (`MaNhaCungCap`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD KEY `FK_matk_review` (`MaTk`),
  ADD KEY `FK_masp_review` (`MaSp`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `thongke`
--
ALTER TABLE `thongke`
  ADD PRIMARY KEY (`MaThongKe`);

--
-- Chỉ mục cho bảng `traicay`
--
ALTER TABLE `traicay`
  ADD PRIMARY KEY (`MaTraiCay`),
  ADD KEY `FK_ma_ncc_x2` (`MaNcc`),
  ADD KEY `FK_maloai` (`MaLoai`),
  ADD KEY `FK_madonvi` (`UnitID`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `banggia`
--
ALTER TABLE `banggia`
  ADD CONSTRAINT `FK_matc_bg2` FOREIGN KEY (`MaSanPham`) REFERENCES `traicay` (`MaTraiCay`);

--
-- Các ràng buộc cho bảng `chatbox`
--
ALTER TABLE `chatbox`
  ADD CONSTRAINT `FK_matkmessage` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  ADD CONSTRAINT `FK_mahd2` FOREIGN KEY (`MaHD`) REFERENCES `hoadon` (`MaHD`),
  ADD CONSTRAINT `FK_matc` FOREIGN KEY (`MaTraiCay`) REFERENCES `traicay` (`MaTraiCay`);

--
-- Các ràng buộc cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `FK_magq` FOREIGN KEY (`MaGQ`) REFERENCES `gioqua` (`MaGioQua`),
  ADD CONSTRAINT `FK_matcay` FOREIGN KEY (`MaTCay`) REFERENCES `traicay` (`MaTraiCay`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `FK_masp_magiay` FOREIGN KEY (`MaSanPham`) REFERENCES `traicay` (`MaTraiCay`),
  ADD CONSTRAINT `FK_matk` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `history_chat`
--
ALTER TABLE `history_chat`
  ADD CONSTRAINT `FK_machat` FOREIGN KEY (`MaChat`) REFERENCES `chatbox` (`chatID`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `FK_matk_x2` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `nhaphang`
--
ALTER TABLE `nhaphang`
  ADD CONSTRAINT `khoangoai` FOREIGN KEY (`MaLoNhap`) REFERENCES `lo_nhap` (`MaLo`),
  ADD CONSTRAINT `khoangoai2` FOREIGN KEY (`MaTraiCay`) REFERENCES `traicay` (`MaTraiCay`),
  ADD CONSTRAINT `khoangoai3` FOREIGN KEY (`MaNhaCungCap`) REFERENCES `nhacungcap` (`MaNcc`);

--
-- Các ràng buộc cho bảng `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_masp_review` FOREIGN KEY (`MaSp`) REFERENCES `traicay` (`MaTraiCay`),
  ADD CONSTRAINT `FK_matk_review` FOREIGN KEY (`MaTk`) REFERENCES `taikhoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `traicay`
--
ALTER TABLE `traicay`
  ADD CONSTRAINT `FK_ma_ncc_x2` FOREIGN KEY (`MaNcc`) REFERENCES `nhacungcap` (`MaNcc`),
  ADD CONSTRAINT `FK_madonvi` FOREIGN KEY (`UnitID`) REFERENCES `donvi` (`MaDonVi`),
  ADD CONSTRAINT `FK_maloai` FOREIGN KEY (`MaLoai`) REFERENCES `loaitraicay` (`MaLoai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
